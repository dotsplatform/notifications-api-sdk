<?php
/**
 * Description of FailNotificationsStubClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Clients;


use Dotsplatform\Notifications\DTO\Request\AccountNotificationsRequestDTO;
use Dotsplatform\Notifications\DTO\AppTokenFormDTO;
use Dotsplatform\Notifications\DTO\PushNotificationsFiltersDTO;
use Dotsplatform\Notifications\DTO\CampaignFormDTO;
use Dotsplatform\Notifications\DTO\Response\PushNotificationsResponseList;
use Dotsplatform\Notifications\DTO\SendAppTokenPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendAppTokenUserPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendUserPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendUsersPushNotifications;
use Dotsplatform\Notifications\Entities\AppToken;
use Dotsplatform\Notifications\Entities\NotificationsAccount;
use Dotsplatform\Notifications\Entities\Campaign;
use Dotsplatform\Notifications\Entities\Campaigns;
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

    public function getAppTokenPushNotifications(PushNotificationsFiltersDTO $dto): PushNotificationsResponseList
    {
        return PushNotificationsResponseList::empty();
    }

    public function getUnreadAppTokenPushNotificationsCount(PushNotificationsFiltersDTO $dto): int
    {
        return 0;
    }

    public function getAccountCampaigns(
        AccountNotificationsRequestDTO $dto,
    ): Campaigns {
        return Campaigns::empty();
    }

    public function createCampaign(CampaignFormDTO $dto): Campaign
    {
        throw new RuntimeException('Store NotificationsCampaign error');
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
}