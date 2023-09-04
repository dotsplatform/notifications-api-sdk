<?php
/**
 * Description of StoreAppTokenDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;

use Dots\Data\DTO;

class AppTokenFormDTO extends DTO
{
    protected string $accountId;
    protected ?string $userId;
    protected int $type;
    protected int $status;
    protected ?string $deviceToken;
    protected array $deviceData;
    protected ?string $lang;
    protected ?string $notificationToken;

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
