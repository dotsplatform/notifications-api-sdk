<?php
/**
 * Description of SendUsersNotifications.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Mamontov Bogdan <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;


use Illuminate\Support\Collection;

/** @extends Collection<int, SendUserNotificationDTO> */
class SendUsersNotifications extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(array_map(
            fn(array $item) => SendUserNotificationDTO::fromArray($item),
            $data,
        ));
    }

    public function toRequestData(): array
    {
       return $this->map(
                fn(SendUserNotificationDTO $item) => $item->toRequestData()
            )->toArray();
    }
}