<?php
/**
 * Description of NotificationsClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications;

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
use Dotsplatform\Notifications\Entities\AppTokens;
use Dotsplatform\Notifications\Entities\Campaign;
use Dotsplatform\Notifications\Entities\Campaigns;
use Dotsplatform\Notifications\Entities\CampaignStatistics;
use Dotsplatform\Notifications\Entities\NotificationsAccount;

interface NotificationsClient
{
    public function storeAppToken(AppTokenFormDTO $dto): AppToken;

    public function updateAppToken(string $id, AppTokenFormDTO $dto): void;

    public function findAppToken(string $id): ?AppToken;

    public function findUserAppTokenByTypes(string $userId, array $appTokenTypes): ?AppToken;

    public function findAccount(string $id): ?NotificationsAccount;

    public function storeAccount(NotificationsAccount $account): void;

    public function sendUsersPushNotifications(string $account, SendUsersPushNotifications $list): void;

    public function sendUserCourierPushNotification(SendUserPushNotificationDTO $dto): void;

    public function sendUserNotification(SendUserNotificationDTO $dto): void;

    public function sendAppTokenPushNotification(SendAppTokenPushNotificationDTO $dto): void;

    public function sendAppTokenUserPushNotification(SendAppTokenUserPushNotificationDTO $dto): void;

    public function getAppTokenPushNotifications(PushNotificationsFiltersDTO $dto): PushNotificationsResponseList;

    public function getAppTokenUnreadPushNotificationsCount(PushNotificationsFiltersDTO $dto): int;

    public function getPushNotifications(PushNotificationsFiltersDTO $dto): PushNotificationsResponseList;

    public function getAccountCampaigns(
        AccountNotificationsRequestDTO $dto,
    ): Campaigns;

    public function createCampaign(CampaignFormDTO $dto): Campaign;

    public function updateCampaign(string $id, CampaignFormDTO $dto): void;

    public function findCampaign(string $accountId, string $id): ?Campaign;

    public function findStatisticsByCampaign(Campaign $campaign): ?CampaignStatistics;

    public function updateStatisticsForCampaign(Campaign $campaign): void;
}
