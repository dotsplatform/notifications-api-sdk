<?php
/**
 * Description of NotificationDeliveryDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO\Response\PushOpens;

use Dots\Data\DTO;

class NotificationDeliveryDTO extends DTO
{
    protected string $id;

    /** Unix seconds of the first "delivered" report. */
    protected ?int $deliveredAt = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getDeliveredAt(): ?int
    {
        return $this->deliveredAt;
    }
}
