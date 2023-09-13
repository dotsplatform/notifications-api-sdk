<?php
/**
 * Description of StoreAppTokenUserPushNotificationDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;


use Dots\Data\DTO;

class SendAppTokenUserPushNotificationDTO extends DTO
{
    protected string $accountId;
    protected string $userId;
    protected string $appTokenId;
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

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getAppTokenId(): string
    {
        return $this->appTokenId;
    }

    public function getPushNotificationData(): PushNotificationDataDTO
    {
        return $this->pushNotificationData;
    }
}