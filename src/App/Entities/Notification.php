<?php
/**
 * Description of Notification.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Mamontov Bogdan <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Entities;

use Dots\Data\Entity;

class Notification extends Entity
{
    public const STATUS_NEW = 0;
    public const STATUS_PROCESSING = 10;
    public const STATUS_COMPLETED = 20;
    public const STATUS_PARTIALLY_COMPLETED = 25;
    public const STATUS_FAILED = 30;

    public const TYPE_SMS = 1;
    public const TYPE_PHONE_CALL = 2;
    public const TYPE_PUSH = 3;
    public const TYPE_EMAIL = 4;
    public const TYPE_WEB = 5;

    public const READ_YES = 1;
    public const READ_NO = 0;

    protected string $id;
    protected string $accountId;
    protected ?string $appTokenId;
    protected ?string $notificationCampaignId;
    protected ?string $orderId;
    protected ?string $userId;
    protected int $status;
    protected int $type;
    protected ?int $sentTime;
    protected int $createdTime;
    protected array $data = [];
    protected int $read = self::READ_NO;
    protected array $providerData = [];

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getAppTokenId(): ?string
    {
        return $this->appTokenId;
    }

    public function getNotificationCampaignId(): ?string
    {
        return $this->notificationCampaignId;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getSentTime(): ?int
    {
        return $this->sentTime;
    }

    public function isRead(): int
    {
        return $this->read;
    }

    public function getPushNotificationType(): ?string
    {
        return $this->data['notificationType'] ?? null;
    }

    public function getProviderData(): array
    {
        return $this->providerData;
    }

    public function getCreatedTime(): int
    {
        return $this->createdTime;
    }
}
