<?php
/**
 * Description of CampaignStatistics.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Mamontov Bogdan <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Entities;

use Dots\Data\Entity;
use Dotsplatform\Notifications\DTO\CampaignStatisticsFieldDTO;
use Illuminate\Support\Collection;

class CampaignStatistics extends Entity
{
    protected Collection $fields;

    /**
     * @return Collection<CampaignStatisticsFieldDTO>
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }
}