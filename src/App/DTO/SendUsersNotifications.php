<?php
/**
 * Description of SendUsersNotifications.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Mamontov Bogdan <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;


use Illuminate\Support\Collection;

/** @extends Collection<int, SendUsersNotificationDTO> */
class SendUsersNotifications extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(array_map(
            fn(array $item) => SendUsersNotificationDTO::fromArray($item),
            $data,
        ));
    }

    public function toRequestData(): array
    {
       return $this->map(
                fn(SendUsersNotificationDTO $item) => $item->toRequestData()
            )->toArray();
    }
}