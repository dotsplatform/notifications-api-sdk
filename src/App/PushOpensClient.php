<?php
/**
 * Description of PushOpensClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications;

use Dotsplatform\Notifications\DTO\Request\CampaignRecipientsRequestDTO;
use Dotsplatform\Notifications\DTO\Response\PushOpens\CampaignPushOpensDTO;
use Dotsplatform\Notifications\DTO\Response\PushOpens\CampaignRecipientsPage;
use Dotsplatform\Notifications\DTO\Response\PushOpens\ExternalReferencePushOpensList;
use Dotsplatform\Notifications\DTO\Response\PushOpens\NotificationOpenDTO;
use Dotsplatform\Notifications\Exceptions\NotificationsRequestException;

/**
 * Push opens (taps) and push campaign recipients.
 *
 * A separate interface (not part of NotificationsClient), so stub clients that implement NotificationsClient
 * keep working. Unlike NotificationsClient it throws when the service fails instead of returning empty data.
 */
interface PushOpensClient
{
    public const int MAX_EXTERNAL_REFERENCES = 100;

    /**
     * The customer tapped the push on this device. Only the first open is stored; repeated calls are harmless.
     *
     * @return NotificationOpenDTO|null null when the notification is not a push of this app token in this account
     * @throws NotificationsRequestException
     */
    public function markNotificationOpened(
        string $accountId,
        string $appTokenId,
        string $notificationId,
    ): ?NotificationOpenDTO;

    /**
     * One page of the campaign's sent pushes, ordered by notification id.
     * Page with `afterId = $page->getNextAfterId()` until `hasNextPage()` is false.
     *
     * @return CampaignRecipientsPage|null null when the campaign is not found in this account
     * @throws NotificationsRequestException
     */
    public function getCampaignRecipients(CampaignRecipientsRequestDTO $dto): ?CampaignRecipientsPage;

    /**
     * @return CampaignPushOpensDTO|null null when the campaign is not found in this account
     * @throws NotificationsRequestException
     */
    public function getCampaignPushOpens(string $accountId, string $campaignId): ?CampaignPushOpensDTO;

    /**
     * Sent / opened push counts per reference, in the requested order (zeros for unknown references).
     * At most MAX_EXTERNAL_REFERENCES references per call.
     *
     * @param string[] $externalReferences
     * @throws NotificationsRequestException
     */
    public function getPushOpensByExternalReferences(
        string $accountId,
        array $externalReferences,
    ): ExternalReferencePushOpensList;
}
