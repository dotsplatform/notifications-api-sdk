<?php
/**
 * Description of StoreUserPushNotificatonsList.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;


use Illuminate\Support\Collection;

/** @extends Collection<int, SendUsersPushNotificationDTO> */
class SendUsersPushNotifications extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(array_map(
            fn(array $item) => SendUsersPushNotificationDTO::fromArray($item),
            $data,
        ));
    }

    public function toRequestData(): array
    {
       return $this->map(
                fn(SendUsersPushNotificationDTO $item) => $item->toRequestData()
            )->toArray();
    }
}