<?php
/**
 * Description of NotificationsClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications;

use Dotsplatform\Notifications\DTO\AppTokenFormDTO;
use Dotsplatform\Notifications\DTO\CampaignFormDTO;
use Dotsplatform\Notifications\DTO\PushNotificationsFiltersDTO;
use Dotsplatform\Notifications\DTO\Response\PushNotificationsResponseList;
use Dotsplatform\Notifications\DTO\SendAppTokenPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendAppTokenUserPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendUserPushNotificationDTO;
use Dotsplatform\Notifications\DTO\SendUserPushNotifications;
use Dotsplatform\Notifications\Entities\AppToken;
use Dotsplatform\Notifications\Entities\Campaign;
use Dotsplatform\Notifications\Entities\Campaigns;
use Dotsplatform\Notifications\Entities\NotificationsAccount;

interface NotificationsClient
{
    public function storeAppToken(AppTokenFormDTO $dto): AppToken;

    public function updateAppToken(string $id, AppTokenFormDTO $dto): void;

    public function findAppToken(string $id): ?AppToken;

    public function findUserAppToken(string $userId): ?AppToken;

    public function findAccount(string $id): ?NotificationsAccount;

    public function storeAccount(NotificationsAccount $account): void;

    public function sendUsersPushes(string $account, SendUserPushNotifications $list): void;

    public function sendUserCourierPush(SendUserPushNotificationDTO $dto): void;

    public function sendAppTokenPushNotification(SendAppTokenPushNotificationDTO $dto): void;

    public function sendAppTokenUserPushNotification(SendAppTokenUserPushNotificationDTO $dto): void;

    public function getAppTokenPushNotifications(PushNotificationsFiltersDTO $dto): PushNotificationsResponseList;

    public function getUnreadAppTokenPushNotificationsCount(PushNotificationsFiltersDTO $dto): int;

    public function getAccountNotificationsCampaigns(
        string $account,
        int $limit,
        int $offset = 0,
    ): Campaigns;

    public function createNotificationsCampaign(CampaignFormDTO $dto): Campaign;

    public function updateNotificationsCampaign(string $id, CampaignFormDTO $dto): void;

    public function findNotificationCampaign(string $accountId, string $id): ?Campaign;
}
