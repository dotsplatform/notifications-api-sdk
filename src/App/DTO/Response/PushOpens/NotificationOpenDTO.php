<?php
/**
 * Description of NotificationOpenDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO\Response\PushOpens;

use Dots\Data\DTO;

class NotificationOpenDTO extends DTO
{
    protected string $id;

    /** Unix seconds of the first open. */
    protected ?int $openedAt = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getOpenedAt(): ?int
    {
        return $this->openedAt;
    }
}
