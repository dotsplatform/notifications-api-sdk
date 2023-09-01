<?php
/**
 * Description of StoreUserPushNotificatonsList.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;


use Illuminate\Support\Collection;

/** @extends Collection<int, StoreUserPushNotificationDTO> */
class StoreUserPushNotificationsList extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(array_map(
            fn(array $item) => StoreUserPushNotificationDTO::fromArray($item),
            $data,
        ));
    }

}