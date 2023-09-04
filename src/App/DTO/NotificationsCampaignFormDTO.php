<?php
/**
 * Description of NotificationsCampaignFormDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;

use Dots\Data\DTO;

class NotificationsCampaignFormDTO extends DTO
{
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
