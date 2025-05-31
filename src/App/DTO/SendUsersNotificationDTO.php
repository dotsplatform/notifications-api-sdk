<?php
/**
 * Description of SendUsersNotificationDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Mamontov Bogdan <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;

use Dots\Data\DTO;

class SendUsersNotificationDTO extends DTO
{
    protected string $accountId;
    protected array $userIds;
    protected NotificationDataDTO $notificationDataDTO;

    public static function fromArray(array $data): static
    {
        $data['notificationData'] = NotificationDataDTO::fromArray($data['notificationData'] ?? []);
        return parent::fromArray($data);
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getUserIds(): array
    {
        return $this->userIds;
    }

    public function getNotificationData(): NotificationDataDTO
    {
        return $this->notificationDataDTO;
    }

    public function toRequestData(): array
    {
        return array_merge([
            'accountId' => $this->getAccountId(),
            'userIds' => $this->getUserIds(),
        ], $this->getNotificationData()->toArray());
    }
}
