<?php
/**
 * Description of NotificationsClient.php
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

interface NotificationsClient
{
    public function storeAppToken(AppTokenFormDTO $dto): AppToken;

    public function updateAppToken(string $id, AppTokenFormDTO $dto): void;

    public function findAppToken(string $account, string $id): ?AppToken;

    public function storeAccount(NotificationsAccount $account): void;

    public function sendUserPush(StoreUserPushNotificationDTO $dto): void;

    public function getAppTokenPushNotifications(GetAppTokenPushNotificationsDTO $dto): PushNotificationsResponseList;

    public function getAppTokenPushNotificationsCount(GetAppTokenPushNotificationsDTO $dto): int;

    public function getAccountNotificationsCampaigns(
        string $account,
        int $limit,
        int $offset = 0,
    ): NotificationsCampaigns;

    public function createNotificationsCampaign(NotificationsCampaignFormDTO $dto): NotificationsCampaign;

    public function updateNotificationsCampaign(string $id, NotificationsCampaignFormDTO $dto): void;

    public function findNotificationCampaign(string $accountId, string $id): ?NotificationsCampaign;
}
