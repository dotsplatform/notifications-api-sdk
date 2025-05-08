<?php
/**
 * Description of NotificationsHttpClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Clients;

use Dotsplatform\Notifications\DTO\Request\AccountNotificationsRequestDTO;
use Dotsplatform\Notifications\DTO\AppTokenFormDTO;
use Dotsplatform\Notifications\DTO\CampaignFormDTO;
use Dotsplatform\Notifications\DTO\PushNotificationsFiltersDTO;
use Dotsplatform\Notifications\DTO\Response\PushNotificationsResponseList;
use Dotsplatform\Notifications\DTO\SendAppTokenPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendAppTokenUserPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendUserNotificationDTO;
use Dotsplatform\Notifications\DTO\SendUserPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendUsersPushNotifications;
use Dotsplatform\Notifications\Entities\AppToken;
use Dotsplatform\Notifications\Entities\CampaignStatistics;
use Dotsplatform\Notifications\Entities\NotificationsAccount;
use Dotsplatform\Notifications\Entities\Campaign;
use Dotsplatform\Notifications\Entities\Campaigns;
use Dotsplatform\Notifications\NotificationsClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class NotificationsHttpClient implements NotificationsClient
{
    private const string FIND_ACCOUNT_URL_TEMPLATE = '/api/accounts/%s';
    private const string STORE_ACCOUNT_URL_TEMPLATE = '/api/accounts';
    private const string ACCOUNT_NOTIFICATIONS_CAMPAIGNS_URL_TEMPLATE = '/api/accounts/%s/campaigns';
    private const string FIND_CAMPAIGN_STATISTICS_URL_TEMPLATE = '/api/accounts/%s/campaigns/%s/statistics';
    private const string UPDATE_CAMPAIGN_STATISTICS_URL_TEMPLATE = '/api/accounts/%s/campaigns/%s/statistics';
    private const string CREATE_NOTIFICATIONS_CAMPAIGNS_URL_TEMPLATE = '/api/accounts/%s/campaigns';
    private const string UPDATE_NOTIFICATIONS_CAMPAIGN_URL_TEMPLATE = '/api/accounts/%s/campaigns/%s';
    private const string FIND_NOTIFICATIONS_CAMPAIGN_URL_TEMPLATE = '/api/accounts/%s/campaigns/%s';
    private const string SEND_USERS_PUSH_NOTIFICATIONS_URL_TEMPLATE = '/api/accounts/%s/notifications/users/push';
    private const string SEND_USER_COURIER_PUSH_NOTIFICATION_URL_TEMPLATE = '/api/accounts/%s/notifications/users/%s/couriers/push';
    private const string SEND_USER_NOTIFICATION_URL_TEMPLATE = '/api/accounts/%s/notifications/users/%s';
    private const string SEND_APP_TOKEN_USER_PUSH_NOTIFICATION_ULR_TEMPLATE = '/api/accounts/%s/notifications/app-tokens/%s/users/%s/push';
    private const string SEND_APP_TOKEN_PUSH_NOTIFICATION_ULR_TEMPLATE = '/api/accounts/%s/notifications/app-tokens/%s/push';
    private const string INDEX_APP_TOKEN_UNREAD_PUSH_NOTIFICATIONS_COUNT_URL_TEMPLATE = '/api/accounts/%s/app-tokens/%s/notifications/push/unread/count';
    private const string INDEX_APP_TOKEN_PUSH_NOTIFICATIONS_URL_TEMPLATE = '/api/accounts/%s/app-tokens/%s/notifications/push';
    private const string INDEX_PUSH_NOTIFICATIONS_URL_TEMPLATE = '/api/accounts/%s/notifications/push';
    private const string STORE_APP_TOKEN_URL_TEMPLATE = '/api/accounts/%s/app-tokens';
    private const string SHOW_APP_TOKEN_URL_TEMPLATE = '/api/app-tokens/%s';
    private const string SHOW_USER_APP_TOKEN_BY_TYPES_URL_TEMPLATE = '/api/app-tokens/users/%s';
    private const string UPDATE_APP_TOKEN_URL_TEMPLATE = '/api/accounts/%s/app-tokens/%s';

    public function storeAppToken(AppTokenFormDTO $dto): AppToken
    {
        $url = sprintf(self::STORE_APP_TOKEN_URL_TEMPLATE, $dto->getAccountId());
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->post($url, ['json' => $dto->toArray()]),
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

    public function findUserAppTokenByTypes(string $userId, array $appTokenTypes): ?AppToken
    {
        $url = sprintf(self::SHOW_USER_APP_TOKEN_BY_TYPES_URL_TEMPLATE, $userId);
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->get($url, ['json' => ['appTokenTypes' => $appTokenTypes]]),
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

    public function sendUsersPushNotifications(string $account, SendUsersPushNotifications $list): void
    {
        $url = sprintf(self::SEND_USERS_PUSH_NOTIFICATIONS_URL_TEMPLATE, $account);
        try {
            $this->makeClient()->post($url, ['json' => ['items' => $list->toRequestData()]]);
        } catch (GuzzleException) {
        }
    }

    public function sendUserCourierPushNotification(SendUserPushNotificationDTO $dto): void
    {
        $url = sprintf(
            self::SEND_USER_COURIER_PUSH_NOTIFICATION_URL_TEMPLATE,
            $dto->getAccountId(),
            $dto->getUserId(),
        );
        try {
            $this->makeClient()->post($url, ['json' => $dto->getPushNotificationData()->toArray()]);
        } catch (GuzzleException) {
        }
    }

    public function sendUserNotification(SendUserNotificationDTO $dto): void
    {
        $url = sprintf(
            self::SEND_USER_NOTIFICATION_URL_TEMPLATE,
            $dto->getAccountId(),
            $dto->getUserId(),
        );
        try {
            $this->makeClient()->post($url, ['json' => $dto->toArray()]);
        } catch (GuzzleException) {
        }
    }

    public function sendAppTokenPushNotification(SendAppTokenPushNotificationDTO $dto): void
    {
        $url = sprintf(
            self::SEND_APP_TOKEN_PUSH_NOTIFICATION_ULR_TEMPLATE,
            $dto->getAccountId(),
            $dto->getAppTokenId(),
        );
        try {
            $this->makeClient()->post($url, ['json' => $dto->getPushNotificationData()->toArray()]);
        } catch (GuzzleException) {
        }
    }

    public function sendAppTokenUserPushNotification(SendAppTokenUserPushNotificationDTO $dto): void
    {
        $url = sprintf(
            self::SEND_APP_TOKEN_USER_PUSH_NOTIFICATION_ULR_TEMPLATE,
            $dto->getAccountId(),
            $dto->getAppTokenId(),
            $dto->getUserId(),
        );
        try {
            $this->makeClient()->post($url, ['json' => $dto->getPushNotificationData()->toArray()]);
        } catch (GuzzleException) {
        }
    }

    public function getAppTokenPushNotifications(PushNotificationsFiltersDTO $dto): PushNotificationsResponseList
    {
        $appTokenId = $dto->getAppTokenId();
        if (is_null($appTokenId)) {
            throw new InvalidArgumentException('AppTokenId cannot be null.');
        }

        $url = sprintf(
            self::INDEX_APP_TOKEN_PUSH_NOTIFICATIONS_URL_TEMPLATE,
            $dto->getAccountId(),
            $appTokenId,
        );
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->get($url, ['json' => $dto->toArray()]),
            );
        } catch (GuzzleException) {
            $data = [];
        }

        return PushNotificationsResponseList::fromArray($data);
    }

    public function getAppTokenUnreadPushNotificationsCount(PushNotificationsFiltersDTO $dto): int
    {
        $appTokenId = $dto->getAppTokenId();
        if (is_null($appTokenId)) {
            throw new InvalidArgumentException('AppTokenId cannot be null.');
        }

        $url = sprintf(self::INDEX_APP_TOKEN_UNREAD_PUSH_NOTIFICATIONS_COUNT_URL_TEMPLATE,
            $dto->getAccountId(),
            $appTokenId,
        );
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->get($url, ['json' => $dto->toArray()]),
            );
            if (empty($data)) {
                return 0;
            }
        } catch (GuzzleException) {
            return 0;
        }

        return $data['count'] ?? 0;
    }

    public function getPushNotifications(PushNotificationsFiltersDTO $dto): PushNotificationsResponseList
    {
        $url = sprintf(
            self::INDEX_PUSH_NOTIFICATIONS_URL_TEMPLATE,
            $dto->getAccountId(),
        );
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->get($url, ['json' => $dto->toArray()]),
            );
        } catch (GuzzleException) {
            $data = [];
        }

        return PushNotificationsResponseList::fromArray($data);
    }

    public function getAccountCampaigns(
        AccountNotificationsRequestDTO $dto,
    ): Campaigns {
        $url = sprintf(self::ACCOUNT_NOTIFICATIONS_CAMPAIGNS_URL_TEMPLATE, $dto->getAccountId());
        try {
            $data = $this->decodeResponse($this->makeClient()->get($url, [
                'json' => $dto->toArray(),
            ]));
        } catch (GuzzleException) {
            $data = [];
        }

        return Campaigns::fromArray($data);
    }

    public function createCampaign(CampaignFormDTO $dto): Campaign
    {
        $url = sprintf(self::CREATE_NOTIFICATIONS_CAMPAIGNS_URL_TEMPLATE, $dto->getAccountId());
        try {
            $data = $this->decodeResponse(
                $this->makeClient()->post($url, ['json' => $dto->toArray()]),
            );

        } catch (GuzzleException) {
            throw new RuntimeException('Create notifications campaign error');
        }
        return Campaign::fromArray($data);
    }

    public function updateCampaign(string $id, CampaignFormDTO $dto): void
    {
        $url = sprintf(self::UPDATE_NOTIFICATIONS_CAMPAIGN_URL_TEMPLATE, $dto->getAccountId(), $id);
        $this->makeClient()->put($url, ['json' => $dto->toArray()]);
    }

    public function findCampaign(string $accountId, string $id): ?Campaign
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

        return Campaign::fromArray($data);
    }

    public function findStatisticsByCampaign(Campaign $campaign): ?CampaignStatistics
    {
        $url = sprintf(self::FIND_CAMPAIGN_STATISTICS_URL_TEMPLATE, $campaign->getAccountId(), $campaign->getId());
        try {
            $data = $this->decodeResponse($this->makeClient()->get($url));
            if (empty($data)) {
                return null;
            }
        } catch (GuzzleException) {
            return null;
        }

        return CampaignStatistics::fromArray($data);
    }

    public function updateStatisticsForCampaign(Campaign $campaign): void
    {
        $url = sprintf(self::UPDATE_CAMPAIGN_STATISTICS_URL_TEMPLATE, $campaign->getAccountId(), $campaign->getId());
        $this->makeClient()->put($url);
    }

    protected function makeClient(): GuzzleClient
    {
        return new GuzzleClient(
            [
                'base_uri' => config('notifications-api-sdk.notifications-server.host'),
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
