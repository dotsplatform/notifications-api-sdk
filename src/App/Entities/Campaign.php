<?php
/**
 * Description of NotificationCampaign.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Entities;

use Dots\Data\Entity;
use Dotsplatform\Notifications\DTO\NotificationsLinkDTO;
use Dotsplatform\Notifications\DTO\NotificationType;

class Campaign extends Entity
{
    public const STATUS_DRAFT = 0;
    public const STATUS_APPROVED = 10;
    public const STATUS_PROCESSING = 20;
    public const STATUS_FINISHED = 30;
    public const STATUS_DECLINED = 40;

    public const RECIPIENT_TYPE_ALL = 1;
    public const RECIPIENT_TYPE_IOS = 2;
    public const RECIPIENT_TYPE_ANDROID = 3;

    public const RECIPIENTS_LEVEL_ADMINS = 0;
    public const RECIPIENTS_LEVEL_MODERATORS = 1;
    public const RECIPIENTS_LEVEL_ALL = 2;

    protected string $id;
    protected ?string $cityId;
    protected ?string $userGroupId;
    protected string $accountId;
    protected int $status;
    protected int $type;
    protected int $recipientType;
    protected string $title;
    protected string $description;
    protected ?int $sendingTime;
    protected int $recipientsLevel;
    protected ?string $image;
    protected NotificationsLinkDTO $linkData;

    public static function fromArray(array $data): static
    {
        $data['linkData'] = NotificationsLinkDTO::fromArray($data['linkData'] ?? []);
        return parent::fromArray($data);
    }

    public function isDraft(): bool
    {
        return $this->getStatus() == self::STATUS_DRAFT;
    }

    public function isApproved(): bool
    {
        return $this->getStatus() == self::STATUS_APPROVED;
    }

    public function isProcessing(): bool
    {
        return $this->getStatus() == self::STATUS_PROCESSING;
    }

    public function isFinished(): bool
    {
        return $this->getStatus() == self::STATUS_FINISHED;
    }

    public function isDeclined(): bool
    {
        return $this->getStatus() == self::STATUS_DECLINED;
    }

    public function isPush(): bool
    {
        return $this->getType() == NotificationType::PUSH;
    }

    public function isRecipientTypeAll(): bool
    {
        return $this->getRecipientType() == self::RECIPIENT_TYPE_ALL;
    }

    public function isIosOnly(): bool
    {
        return $this->getRecipientType() == self::RECIPIENT_TYPE_IOS;
    }

    public function isAndroidOnly(): bool
    {
        return $this->getRecipientType() == self::RECIPIENT_TYPE_ANDROID;
    }

    public function isRecipientsLevelAdmins(): bool
    {
        return $this->getRecipientsLevel() == self::RECIPIENTS_LEVEL_ADMINS;
    }

    public function isRecipientsLevelModerator(): bool
    {
        return $this->getRecipientsLevel() == self::RECIPIENTS_LEVEL_MODERATORS;
    }

    public function isRecipientsLevelAll(): bool
    {
        return $this->getRecipientsLevel() == self::RECIPIENTS_LEVEL_ALL;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCityId(): ?string
    {
        return $this->cityId;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getRecipientType(): int
    {
        return $this->recipientType;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSendingTime(): ?int
    {
        return $this->sendingTime;
    }

    public function getRecipientsLevel(): int
    {
        return $this->recipientsLevel;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getLinkData(): NotificationsLinkDTO
    {
        return $this->linkData;
    }

    public function getUserGroupId(): ?string
    {
        return $this->userGroupId;
    }
}
