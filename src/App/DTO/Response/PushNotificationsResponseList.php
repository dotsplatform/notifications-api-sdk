<?php
/**
 * Description of PushNotificationResponseList.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO\Response;

use Illuminate\Support\Collection;

/** @extends Collection<int, PushNotificationResponseDTO> */
class PushNotificationsResponseList extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(array_map(
            fn (array $item) => PushNotificationResponseDTO::fromArray($item),
            $data,
        ));
    }
}
