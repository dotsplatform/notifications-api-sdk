<?php
/**
 * Description of NotificationsCampaigns.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Entities;

use Illuminate\Support\Collection;

/** @extends Collection<int, NotificationsCampaign> */
class NotificationsCampaigns extends Collection
{
    public static function fromArray(array $data): self
    {
        return new self(array_map(
            fn (array $item) => NotificationsCampaign::fromArray($item),
            $data,
        ));
    }

}
