<?php
/**
 * Description of CampaignStatisticsFieldDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Mamontov Bogdan <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;

use Dots\Data\DTO;

class CampaignStatisticsFieldDTO extends DTO
{
    protected string $name;
    protected int $amount;
    protected int $percentOfSent;

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getPercentOfSent(): int
    {
        return $this->percentOfSent;
    }
}