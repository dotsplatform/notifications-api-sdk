<?php
/**
 * Description of CampaignPushOpensDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO\Response\PushOpens;

use Dots\Data\DTO;

class CampaignPushOpensDTO extends DTO
{
    protected string $campaignId;

    protected int $sentCount = 0;

    protected int $openedCount = 0;

    public function getCampaignId(): string
    {
        return $this->campaignId;
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
