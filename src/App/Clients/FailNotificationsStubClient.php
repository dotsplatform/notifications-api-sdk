<?php
/**
 * Description of FailNotificationsStubClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Clients;


use Dotsplatform\Notifications\DTO\AppTokenFormDTO;
use Dotsplatform\Notifications\DTO\GetAppTokenPushNotificationsDTO;
use Dotsplatform\Notifications\DTO\NotificationsCampaignFormDTO;
use Dotsplatform\Notifications\DTO\Response\PushNotificationsResponseList;
use Dotsplatform\Notifications\DTO\StoreUserPushNotificationDTO;
use Dotsplatform\Notifications\Entities\AppToken;
use Dotsplatform\Notifications\Entities\NotificationsAccount;
use Dotsplatform\Notifications\Entities\NotificationsCampaign;
use Dotsplatform\Notifications\Entities\NotificationsCampaigns;
use Dotsplatform\Notifications\NotificationsClient;
use RuntimeException;

class FailNotificationsStubClient implements NotificationsClient
{
    public function storeAppToken(AppTokenFormDTO $dto): AppToken
    {
        throw new RuntimeException('Store App token error');
    }

    public function updateAppToken(string $id, AppTokenFormDTO $dto): void
    {
        // TODO: Implement updateAppToken() method.
    }

    public function findAppToken(string $id): ?AppToken
    {
        return null;
    }

    public function findAccount(string $id): ?NotificationsAccount
    {
        return null;
    }

    public function storeAccount(NotificationsAccount $account): void
    {
        // TODO: Implement storeAccount() method.
    }

    public function sendUserPush(StoreUserPushNotificationDTO $dto): void
    {
        // TODO: Implement sendUserPush() method.
    }

    public function getAppTokenPushNotifications(GetAppTokenPushNotificationsDTO $dto): PushNotificationsResponseList
    {
        return PushNotificationsResponseList::empty();
    }

    public function getAppTokenPushNotificationsCount(GetAppTokenPushNotificationsDTO $dto): int
    {
        return 0;
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
        throw new RuntimeException('Store NotificationsCampaign error');
    }

    public function updateNotificationsCampaign(string $id, NotificationsCampaignFormDTO $dto): void
    {
        // TODO: Implement updateNotificationsCampaign() method.
    }

    public function findNotificationCampaign(string $accountId, string $id): ?NotificationsCampaign
    {
        return null;
    }
}