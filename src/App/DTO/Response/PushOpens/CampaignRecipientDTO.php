<?php
/**
 * Description of CampaignRecipientDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO\Response\PushOpens;

use Dots\Data\DTO;

/**
 * One sent push of a campaign: one device of one customer. A customer with two devices appears twice,
 * a device without a customer has no user id.
 */
class CampaignRecipientDTO extends DTO
{
    protected string $notificationId;

    protected ?string $userId = null;

    protected ?string $appTokenId = null;

    /** Unix seconds. */
    protected ?int $sentTime = null;

    /** Unix seconds of the first tap, null when not opened (or the app does not report taps). */
    protected ?int $openedAt = null;

    public function getNotificationId(): string
    {
        return $this->notificationId;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function getAppTokenId(): ?string
    {
        return $this->appTokenId;
    }

    public function getSentTime(): ?int
    {
        return $this->sentTime;
    }

    public function getOpenedAt(): ?int
    {
        return $this->openedAt;
    }
}
