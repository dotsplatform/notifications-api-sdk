<?php
/**
 * Description of PushOpensHttpClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Clients;

use Dotsplatform\Notifications\DTO\Request\CampaignRecipientsRequestDTO;
use Dotsplatform\Notifications\DTO\Response\PushOpens\CampaignPushOpensDTO;
use Dotsplatform\Notifications\DTO\Response\PushOpens\CampaignRecipientsPage;
use Dotsplatform\Notifications\DTO\Response\PushOpens\ExternalReferencePushOpensList;
use Dotsplatform\Notifications\DTO\Response\PushOpens\NotificationOpenDTO;
use Dotsplatform\Notifications\Exceptions\NotificationsRequestException;
use Dotsplatform\Notifications\PushOpensClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

class PushOpensHttpClient implements PushOpensClient
{
    private const string INTERNAL_GATEWAY_TOKEN_HEADER = 'X-Internal-Gateway-Token';

    private const string MARK_NOTIFICATION_OPENED_URL_TEMPLATE = '/api/accounts/%s/app-tokens/%s/notifications/%s/opened';
    private const string CAMPAIGN_RECIPIENTS_URL_TEMPLATE = '/api/accounts/%s/campaigns/%s/recipients';
    private const string CAMPAIGN_PUSH_OPENS_URL_TEMPLATE = '/api/accounts/%s/campaigns/%s/opens';
    private const string EXTERNAL_REFERENCES_PUSH_OPENS_URL_TEMPLATE = '/api/accounts/%s/notifications/push/opens';

    private const int CONNECT_TIMEOUT_SECONDS = 2;
    private const int TIMEOUT_SECONDS = 10;

    private const int HTTP_NOT_FOUND = 404;

    public function markNotificationOpened(
        string $accountId,
        string $appTokenId,
        string $notificationId,
    ): ?NotificationOpenDTO {
        $url = sprintf(self::MARK_NOTIFICATION_OPENED_URL_TEMPLATE, $accountId, $appTokenId, $notificationId);
        $response = $this->send('POST', $url, []);
        if ($this->isNotFound($response)) {
            return null;
        }

        return NotificationOpenDTO::fromArray($this->decodeSuccessfulResponse($url, $response));
    }

    public function getCampaignRecipients(CampaignRecipientsRequestDTO $dto): ?CampaignRecipientsPage
    {
        $url = sprintf(self::CAMPAIGN_RECIPIENTS_URL_TEMPLATE, $dto->getAccountId(), $dto->getCampaignId());
        $response = $this->send('GET', $url, [
            RequestOptions::QUERY => $dto->toQuery(),
        ]);
        if ($this->isNotFound($response)) {
            return null;
        }

        return CampaignRecipientsPage::fromArray($this->decodeSuccessfulResponse($url, $response));
    }

    public function getCampaignPushOpens(string $accountId, string $campaignId): ?CampaignPushOpensDTO
    {
        $url = sprintf(self::CAMPAIGN_PUSH_OPENS_URL_TEMPLATE, $accountId, $campaignId);
        $response = $this->send('GET', $url, []);
        if ($this->isNotFound($response)) {
            return null;
        }

        return CampaignPushOpensDTO::fromArray($this->decodeSuccessfulResponse($url, $response));
    }

    public function getPushOpensByExternalReferences(
        string $accountId,
        array $externalReferences,
    ): ExternalReferencePushOpensList {
        if (empty($externalReferences)) {
            return new ExternalReferencePushOpensList();
        }
        if (count($externalReferences) > self::MAX_EXTERNAL_REFERENCES) {
            throw new InvalidArgumentException(
                'At most ' . self::MAX_EXTERNAL_REFERENCES . ' external references per call',
            );
        }

        $url = sprintf(self::EXTERNAL_REFERENCES_PUSH_OPENS_URL_TEMPLATE, $accountId);
        $response = $this->send('GET', $url, [
            RequestOptions::QUERY => [
                'externalReferences' => array_values($externalReferences),
            ],
        ]);
        $data = $this->decodeSuccessfulResponse($url, $response);

        $items = $data['items'] ?? [];
        if (!is_array($items)) {
            $items = [];
        }

        return ExternalReferencePushOpensList::fromArray($items);
    }

    /**
     * @param array<string, mixed> $options
     * @throws NotificationsRequestException
     */
    private function send(string $method, string $url, array $options): ResponseInterface
    {
        try {
            return $this->makeClient()->request($method, $url, $options);
        } catch (GuzzleException $exception) {
            throw new NotificationsRequestException(
                'Notifications service is not reachable: ' . $exception->getMessage(),
                0,
                $exception,
            );
        }
    }

    private function isNotFound(ResponseInterface $response): bool
    {
        return $response->getStatusCode() === self::HTTP_NOT_FOUND;
    }

    /**
     * @return array<string, mixed>
     * @throws NotificationsRequestException
     */
    private function decodeSuccessfulResponse(string $url, ResponseInterface $response): array
    {
        $status = $response->getStatusCode();
        if ($status < 200 || $status >= 300) {
            throw new NotificationsRequestException(
                sprintf('Notifications service answered with HTTP %d for %s', $status, $url),
            );
        }

        $data = json_decode((string) $response->getBody(), true);
        if (!is_array($data)) {
            throw new NotificationsRequestException('Notifications service answered with a body that is not JSON: ' . $url);
        }

        return $data;
    }

    private function getInternalGatewayToken(): string
    {
        $token = config('notifications-api-sdk.notifications-server.token');
        if (!is_string($token)) {
            return '';
        }

        return $token;
    }

    /**
     * `http_errors` is off: the status is checked here, so a 404 is an answer and not an exception.
     */
    protected function makeClient(): GuzzleClient
    {
        return new GuzzleClient([
            'base_uri' => config('notifications-api-sdk.notifications-server.host'),
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::CONNECT_TIMEOUT => self::CONNECT_TIMEOUT_SECONDS,
            RequestOptions::TIMEOUT => self::TIMEOUT_SECONDS,
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                self::INTERNAL_GATEWAY_TOKEN_HEADER => $this->getInternalGatewayToken(),
            ],
        ]);
    }
}
