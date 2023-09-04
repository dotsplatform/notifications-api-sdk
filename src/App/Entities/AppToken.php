<?php
/**
 * Description of AppToken.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Entities;

use Dots\Data\Entity;

class AppToken extends Entity
{
    public const TYPE_APP_IOS = 1;
    public const TYPE_APP_ANDROID = 2;
    public const TYPE_APP_BUSINESS_COURIER = 3;
    public const TYPE_BROWSER = 4;
    public const TYPE_WEB_APP_BUSINESS_COMPANY = 5;
    public const TYPE_APP_BUSINESS_METRICS = 6;

    public const STATUS_ACTIVE = 10;
    public const STATUS_INACTIVE = 20;
    public const STATUS_BANNED = 30;

    protected string $id;
    protected string $accountId;
    protected ?string $userId;
    protected int $type;
    protected int $status;
    protected ?string $deviceToken;
    protected array $deviceData;
    protected ?string $lang;
    protected ?string $notificationToken;

    public function getAppVersion(): ?string
    {
        return $this->deviceData['appVersion'] ?? null;
    }

    public function getApiVersion(): ?string
    {
        return $this->deviceData['apiVersion'] ?? null;
    }

    public function isAppAndroid(): bool
    {
        return $this->getType() === self::TYPE_APP_ANDROID;
    }

    public function isAppIOS(): bool
    {
        return $this->getType() === self::TYPE_APP_IOS;
    }

    public function isAppCourierBusiness(): bool
    {
        return $this->getType() === self::TYPE_APP_BUSINESS_COURIER;
    }

    public function isActive(): bool
    {
        return $this->getStatus() === self::STATUS_ACTIVE;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getDeviceToken(): ?string
    {
        return $this->deviceToken;
    }

    public function getDeviceData(): array
    {
        return $this->deviceData;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function getNotificationToken(): ?string
    {
        return $this->notificationToken;
    }
}
