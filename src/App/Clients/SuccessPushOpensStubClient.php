<?php
/**
 * Description of SuccessPushOpensStubClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Clients;

use Dotsplatform\Notifications\DTO\Request\CampaignRecipientsRequestDTO;
use Dotsplatform\Notifications\DTO\Response\PushOpens\CampaignPushOpensDTO;
use Dotsplatform\Notifications\DTO\Response\PushOpens\CampaignRecipientsPage;
use Dotsplatform\Notifications\DTO\Response\PushOpens\ExternalReferencePushOpensDTO;
use Dotsplatform\Notifications\DTO\Response\PushOpens\ExternalReferencePushOpensList;
use Dotsplatform\Notifications\DTO\Response\PushOpens\NotificationOpenDTO;
use Dotsplatform\Notifications\PushOpensClient;

/**
 * For tests of the services that use the SDK: every open succeeds now, campaigns have no recipients,
 * every reference has zero pushes.
 */
class SuccessPushOpensStubClient implements PushOpensClient
{
    public function markNotificationOpened(
        string $accountId,
        string $appTokenId,
        string $notificationId,
    ): ?NotificationOpenDTO {
        return NotificationOpenDTO::fromArray([
            'id' => $notificationId,
            'openedAt' => time(),
        ]);
    }

    public function getCampaignRecipients(CampaignRecipientsRequestDTO $dto): ?CampaignRecipientsPage
    {
        return new CampaignRecipientsPage([], null);
    }

    public function getCampaignPushOpens(string $accountId, string $campaignId): ?CampaignPushOpensDTO
    {
        return CampaignPushOpensDTO::fromArray([
            'campaignId' => $campaignId,
        ]);
    }

    public function getPushOpensByExternalReferences(
        string $accountId,
        array $externalReferences,
    ): ExternalReferencePushOpensList {
        $list = new ExternalReferencePushOpensList();
        foreach ($externalReferences as $externalReference) {
            $list->push(ExternalReferencePushOpensDTO::fromArray([
                'externalReference' => $externalReference,
            ]));
        }

        return $list;
    }
}
