<?php
/**
 * Description of SuccessNotificationsStubClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Clients;


use Dotsplatform\Notifications\DTO\AppTokenFormDTO;
use Dotsplatform\Notifications\DTO\GetAppTokenPushNotificationsDTO;
use Dotsplatform\Notifications\DTO\NotificationsCampaignFormDTO;
use Dotsplatform\Notifications\DTO\Response\PushNotificationResponseDTO;
use Dotsplatform\Notifications\DTO\Response\PushNotificationsResponseList;
use Dotsplatform\Notifications\DTO\StoreUserPushNotificationsList;
use Dotsplatform\Notifications\Entities\AppToken;
use Dotsplatform\Notifications\Entities\NotificationsAccount;
use Dotsplatform\Notifications\Entities\NotificationsCampaign;
use Dotsplatform\Notifications\Entities\NotificationsCampaigns;
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

    public function getAppTokenPushNotifications(GetAppTokenPushNotificationsDTO $dto): PushNotificationsResponseList
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

    public function getAppTokenPushNotificationsCount(GetAppTokenPushNotificationsDTO $dto): int
    {
        return 1;
    }

    public function getAccountNotificationsCampaigns(
        string $account,
        int $limit,
        int $offset = 0,
    ): NotificationsCampaigns {
        return NotificationsCampaigns::empty();
    }

    public function createNotificationsCampaign(NotificationsCampaignFormDTO $dto): NotificationsCampaign
    {
        return NotificationsCampaign::fromArray(array_merge([
            'id' => Str::uuid()->toString(),
        ], $dto->toArray()));
    }

    public function updateNotificationsCampaign(string $id, NotificationsCampaignFormDTO $dto): void
    {
        // TODO: Implement updateNotificationsCampaign() method.
    }

    public function findNotificationCampaign(string $accountId, string $id): ?NotificationsCampaign
    {
        return null;
    }

    public function sendUserPush(string $account, StoreUserPushNotificationsList $list): void
    {
        // TODO: Implement sendUserPush() method.
    }
}