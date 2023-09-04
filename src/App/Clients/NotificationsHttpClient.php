<?php
/**
 * Description of NotificationsHttpClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Clients;

use Dotsplatform\Notifications\DTO\AppTokenFormDTO;
use Dotsplatform\Notifications\DTO\GetAppTokenPushNotificationsDTO;
use Dotsplatform\Notifications\DTO\NotificationsCampaignFormDTO;
use Dotsplatform\Notifications\DTO\Response\PushNotificationsResponseList;
use Dotsplatform\Notifications\DTO\StoreUserPushNotificationsList;
use Dotsplatform\Notifications\Entities\AppToken;
use Dotsplatform\Notifications\Entities\NotificationsAccount;
use Dotsplatform\Notifications\Entities\NotificationsCampaign;
use Dotsplatform\Notifications\Entities\NotificationsCampaigns;
use Dotsplatform\Notifications\NotificationsClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class NotificationsHttpClient implements NotificationsClient
{
    private const FIND_ACCOUNT_URL_TEMPLATE = '/api/accounts/%s';
    private const STORE_ACCOUNT_URL_TEMPLATE = '/api/accounts';
    private const ACCOUNT_NOTIFICATIONS_CAMPAIGNS_URL_TEMPLATE = '/api/accounts/%s/notifications-campaigns';
    private const CREATE_NOTIFICATIONS_CAMPAIGNS_URL_TEMPLATE = '/api/accounts/%s/notifications-campaigns';
    private const UPDATE_NOTIFICATIONS_CAMPAIGN_URL_TEMPLATE = '/api/accounts/%s/notifications-campaigns/%s';
    private const FIND_NOTIFICATIONS_CAMPAIGN_URL_TEMPLATE = '/api/accounts/%s/notifications-campaigns/%s';
    private const STORE_USERS_PUSH_NOTIFICATIONS_URL_TEMPLATE = '/api/accounts/%s/notifications/users/push';
    private const GET_APP_TOKEN_PUSH_NOTIFICATIONS_COUNT_URL_TEMPLATE = '/api/accounts/%s/app-tokens/%s/notifications/push/count';
    private const INDEX_APP_TOKEN_PUSH_NOTIFICATIONS_URL_TEMPLATE = '/api/accounts/%s/app-tokens/%s/notifications/push';
    private const STORE_APP_TOKEN_URL_TEMPLATE = '/api/accounts/%s/app-tokens';
    private const SHOW_APP_TOKEN_URL_TEMPLATE = '/api/app-tokens/%s';
    private const SHOW_USER_APP_TOKEN_URL_TEMPLATE = '/api/app-tokens/users/%s';
    private const UPDATE_APP_TOKEN_URL_TEMPLATE = '/api/accounts/%s/app-tokens/%s';

    public function storeAppToken(AppTokenFormDTO $dto): AppToken
    {
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->post(self::STORE_APP_TOKEN_URL_TEMPLATE, ['json' => $dto->toArray()]),
            );
        } catch (GuzzleException) {
            $data = [];
        }

        return AppToken::fromArray($data);
    }

    public function updateAppToken(string $id, AppTokenFormDTO $dto): void
    {
        $url = sprintf(self::UPDATE_APP_TOKEN_URL_TEMPLATE, $dto->getAccountId(), $id);
        try {
            $this->makeClient()->put($url, ['json' => $dto->toArray()]);
        } catch (GuzzleException) {
        }
    }

    public function findAppToken(string $id): ?AppToken
    {
        $url = sprintf(self::SHOW_APP_TOKEN_URL_TEMPLATE, $id);
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->get($url),
            );
            if (empty($data)) {
                return null;
            }
        } catch (GuzzleException) {
            return null;
        }

        return AppToken::fromArray($data);
    }

    public function findUserAppToken(string $userId): ?AppToken
    {
        $url = sprintf(self::SHOW_USER_APP_TOKEN_URL_TEMPLATE, $userId);
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->get($url),
            );
            if (empty($data)) {
                return null;
            }
        } catch (GuzzleException) {
            return null;
        }

        return AppToken::fromArray($data);
    }

    public function findAccount(string $id): ?NotificationsAccount
    {
        $url = sprintf(self::FIND_ACCOUNT_URL_TEMPLATE, $id);
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->get($url),
            );
            if (empty($data)) {
                return null;
            }
        } catch (GuzzleException) {
            return null;
        }

        return NotificationsAccount::fromArray($data);
    }

    public function storeAccount(NotificationsAccount $account): void
    {
        try {
            $this->makeClient()->post(self::STORE_ACCOUNT_URL_TEMPLATE, ['json' => $account->toArray()]);
        } catch (GuzzleException) {
        }
    }

    public function sendUserPush(string $account, StoreUserPushNotificationsList $list,): void
    {
        $url = sprintf(self::STORE_USERS_PUSH_NOTIFICATIONS_URL_TEMPLATE, $account);
        try {
            $this->makeClient()->post($url, ['json' => ['items' => $list->toArray()]]);
        } catch (GuzzleException) {
        }
    }

    public function getAppTokenPushNotifications(GetAppTokenPushNotificationsDTO $dto): PushNotificationsResponseList
    {
        $url = sprintf(
            self::GET_APP_TOKEN_PUSH_NOTIFICATIONS_COUNT_URL_TEMPLATE,
            $dto->getAccount(),
            $dto->getAppToken(),
        );
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->get($url, $dto->toArray()),
            );
        } catch (GuzzleException) {
            $data = [];
        }

        return PushNotificationsResponseList::fromArray($data);
    }

    public function getAppTokenPushNotificationsCount(GetAppTokenPushNotificationsDTO $dto): int
    {
        $url = sprintf(self::INDEX_APP_TOKEN_PUSH_NOTIFICATIONS_URL_TEMPLATE, $dto->getAccount(), $dto->getAppToken());
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->get($url, $dto->toArray()),
            );
            if (empty($data)) {
                return 0;
            }
        } catch (GuzzleException) {
            return 0;
        }

        return $data['count'] ?? 0;
    }

    public function getAccountNotificationsCampaigns(
        string $account,
        int $limit,
        int $offset = 0,
    ): NotificationsCampaigns {
        $url = sprintf(self::ACCOUNT_NOTIFICATIONS_CAMPAIGNS_URL_TEMPLATE, $account);
        try {
            $data = $this->decodeResponse($this->makeClient()->get($url, [
                'limit' => $limit,
                'offset' => $offset,
            ]));
        } catch (GuzzleException) {
            $data = [];
        }

        return NotificationsCampaigns::fromArray($data);
    }

    public function createNotificationsCampaign(NotificationsCampaignFormDTO $dto): NotificationsCampaign
    {
        $url = sprintf(self::CREATE_NOTIFICATIONS_CAMPAIGNS_URL_TEMPLATE, $dto->getAccountId());
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->post($url, ['json' => $dto->toArray()]),
            );

        } catch (GuzzleException) {
            throw new RuntimeException('Create notifications campaign error');
        }
        return NotificationsCampaign::fromArray($data);
    }

    public function updateNotificationsCampaign(string $id, NotificationsCampaignFormDTO $dto): void
    {
        $url = sprintf(self::UPDATE_NOTIFICATIONS_CAMPAIGN_URL_TEMPLATE, $dto->getAccountId(), $id);
        $this->makeClient()->put($url, ['json' => $dto->toArray()]);
    }

    public function findNotificationCampaign(string $accountId, string $id): ?NotificationsCampaign
    {
        $url = sprintf(self::FIND_NOTIFICATIONS_CAMPAIGN_URL_TEMPLATE, $accountId, $id);
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->get($url),
            );
            if (empty($data)) {
                return null;
            }
        } catch (GuzzleException) {
            return null;
        }

        return NotificationsCampaign::fromArray($data);
    }

    protected function makeClient(): GuzzleClient
    {
        return new GuzzleClient(
            [
                'base_uri' => config('resources.notifications.external.host'),
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }

    private function decodeResponse(ResponseInterface $response): array
    {
        $responseBody = (string)$response->getBody();
        $data = json_decode($responseBody, true);
        if (!$data) {
            return [];
        }
        return $data;
    }
}
