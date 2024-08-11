<?php
/**
 * Description of SuccessNotificationsStubClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Clients;


use Dotsplatform\Notifications\DTO\Request\AccountNotificationsRequestDTO;
use Dotsplatform\Notifications\DTO\AppTokenFormDTO;
use Dotsplatform\Notifications\DTO\PushNotificationsFiltersDTO;
use Dotsplatform\Notifications\DTO\CampaignFormDTO;
use Dotsplatform\Notifications\DTO\Response\PushNotificationResponseDTO;
use Dotsplatform\Notifications\DTO\Response\PushNotificationsResponseList;
use Dotsplatform\Notifications\DTO\SendAppTokenPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendAppTokenUserPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendUserPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendUsersPushNotifications;
use Dotsplatform\Notifications\Entities\AppToken;
use Dotsplatform\Notifications\Entities\CampaignStatistics;
use Dotsplatform\Notifications\Entities\NotificationsAccount;
use Dotsplatform\Notifications\Entities\Campaign;
use Dotsplatform\Notifications\Entities\Campaigns;
use Dotsplatform\Notifications\NotificationsClient;
use Illuminate\Support\Str;

class SuccessNotificationsStubClient implements NotificationsClient
{
    public function storeAppToken(AppTokenFormDTO $dto): AppToken
    {
        return AppToken::fromArray(array_merge([
            'id' => Str::uuid()->toString(),
        ], $dto->toArray()));
    }

    public function updateAppToken(string $id, AppTokenFormDTO $dto): void
    {
        // TODO: Implement updateAppToken() method.
    }

    public function findAppToken(string $id): ?AppToken
    {
        return AppToken::fromArray([
            'id' => $id,
            'accountId' => Str::uuid()->toString(),
            'deviceToken' => Str::uuid()->toString(),
            'deviceData' => [],
            'userId' => Str::uuid()->toString(),
            'type' => AppToken::TYPE_APP_IOS,
            'status' => AppToken::STATUS_ACTIVE,
            'lang' => 'ua',
        ]);
    }

    public function findAccount(string $id): ?NotificationsAccount
    {
        return NotificationsAccount::fromArray([
            'id' => $id,
            'name' => Str::uuid()->toString(),
            'lang' => 'ua',
            'data' => []
        ]);
    }

    public function storeAccount(NotificationsAccount $account): void
    {
        // TODO: Implement storeAccount() method.
    }

    public function getPushNotifications(PushNotificationsFiltersDTO $dto): PushNotificationsResponseList
    {
        return PushNotificationsResponseList::fromArray([
            [
                'id' => Str::uuid()->toString(),
                'title' => Str::uuid()->toString(),
                'text' => Str::uuid()->toString(),
                'image' => Str::uuid()->toString(),
                'sent_at' => time(),
                'read' => PushNotificationResponseDTO::READ_NO,
                'pushNotificationActionData' => [],
                'linkData' => [
                    'url' => Str::uuid()->toString(),
                ]
            ]
        ]);
    }

    public function getUnreadPushNotificationsCount(PushNotificationsFiltersDTO $dto): int
    {
        return 1;
    }

    public function getAccountCampaigns(
        AccountNotificationsRequestDTO $dto,
    ): Campaigns {
        return Campaigns::empty();
    }

    public function createCampaign(CampaignFormDTO $dto): Campaign
    {
        return Campaign::fromArray(array_merge([
            'id' => Str::uuid()->toString(),
        ], $dto->toArray()));
    }

    public function updateCampaign(string $id, CampaignFormDTO $dto): void
    {
        // TODO: Implement updateNotificationsCampaign() method.
    }

    public function findCampaign(string $accountId, string $id): ?Campaign
    {
        return null;
    }

    public function sendUsersPushNotifications(string $account, SendUsersPushNotifications $list): void
    {
        // TODO: Implement sendUserPush() method.
    }

    public function findUserAppTokenByTypes(string $userId, array $appTokenTypes): ?AppToken
    {
        return null;
    }

    public function sendUserCourierPushNotification(SendUserPushNotificationDTO $dto): void
    {
        // TODO: Implement sendUserCourierPush() method.
    }

    public function sendAppTokenUserPushNotification(SendAppTokenUserPushNotificationDTO $dto): void
    {
        // TODO: Implement sendAppTokenPushNotification() method.
    }

    public function sendAppTokenPushNotification(SendAppTokenPushNotificationDTO $dto): void
    {
        // TODO: Implement sendAppTokenPushNotification() method.
    }

    public function findStatisticsByCampaign(Campaign $campaign): ?CampaignStatistics
    {
        return CampaignStatistics::fromArray([
            'id' => $campaign->getId(),
            'accountId' => $campaign->getAccountId(),
            'totalCount' => random_int(1, 100),
            'successCount' => random_int(1, 20),
            'failCount' => random_int(1, 20),
            'readCount' => random_int(1, 20),
            'unreadCount' => random_int(1, 20),
        ]);
    }

    public function updateStatisticsForCampaign(Campaign $campaign): void
    {
        // TODO: Implement updateStatisticsForCampaign() method.
    }
}