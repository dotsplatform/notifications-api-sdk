<?php
/**
 * Description of StoreNotificationDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;

use Dots\Data\DTO;

class SendUsersPushNotificationDTO extends DTO
{
    protected string $accountId;
    protected array $userIds;
    protected PushNotificationDataDTO $pushNotificationData;

    public static function fromArray(array $data): static
    {
        $data['pushNotificationData'] = PushNotificationDataDTO::fromArray($data['pushNotificationData'] ?? []);
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

    public function getPushNotificationData(): PushNotificationDataDTO
    {
        return $this->pushNotificationData;
    }

    public function toRequestData(): array
    {
        return array_merge([
            'accountId' => $this->getAccountId(),
            'userIds' => $this->getUserIds(),
        ], $this->getPushNotificationData()->toArray());
    }
}
