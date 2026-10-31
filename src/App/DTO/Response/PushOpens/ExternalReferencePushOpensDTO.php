<?php
/**
 * Description of ExternalReferencePushOpensDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO\Response\PushOpens;

use Dots\Data\DTO;

class ExternalReferencePushOpensDTO extends DTO
{
    protected string $externalReference;

    protected int $sentCount = 0;

    protected int $openedCount = 0;

    public function getExternalReference(): string
    {
        return $this->externalReference;
    }

    public function getSentCount(): int
    {
        return $this->sentCount;
    }

    public function getOpenedCount(): int
    {
        return $this->openedCount;
    }
}
