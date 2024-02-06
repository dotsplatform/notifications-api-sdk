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
    protected string $accountId;

    protected string $campaignId;

    protected Collection $fields;

    public static function fromArray(array $data): static
    {
        $data['fields'] = collect($data['fields'])
            ->map(function (array $fieldData) {
                return CampaignStatisticsFieldDTO::fromArray($fieldData);
            });

        return parent::fromArray($data);
    }

    /**
     * @return Collection<CampaignStatisticsFieldDTO>
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getCampaignId(): string
    {
        return $this->campaignId;
    }
}