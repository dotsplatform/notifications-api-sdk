<?php
/**
 * Description of SendUserNotificationDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Mamontov Bogdan <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;

use Dots\Data\DTO;
use Dotsplatform\Notifications\Entities\Notification;

class SendUserNotificationDTO extends DTO
{
    protected string $accountId;

    protected string $userId;

    protected ?string $phone;

    protected string $message;

    protected ?string $title = null;

    protected array $methods = [
        Notification::TYPE_PUSH,
        Notification::TYPE_SMS,
    ];

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }
}