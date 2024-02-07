<?php
/**
 * Description of CampaignStatistics.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Mamontov Bogdan <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Entities;

use Dots\Data\Entity;

class CampaignStatistics extends Entity
{
    protected string $id;

    protected string $accountId;

    protected int $totalAmount = 0;

    protected int $successAmount = 0;

    protected int $failAmount = 0;

    protected int $readAmount = 0;

    protected int $unreadAmount = 0;

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    public function getSuccessAmount(): int
    {
        return $this->successAmount;
    }

    public function getFailAmount(): int
    {
        return $this->failAmount;
    }

    public function getReadAmount(): int
    {
        return $this->readAmount;
    }

    public function getUnreadAmount(): int
    {
        return $this->unreadAmount;
    }

    public function getPercentTotalAmount(): int
    {
        return $this->getTotalAmount();
    }

    public function getPercentSuccessAmount(): int
    {
        return $this->getPercentOfTotalAmount($this->getSuccessAmount());
    }

    public function getPercentFailAmount(): int
    {
        return $this->getPercentOfTotalAmount($this->getFailAmount());
    }

    public function getPercentReadAmount(): int
    {
        return $this->getPercentOfTotalAmount($this->getReadAmount());
    }

    public function getPercentUnreadAmount(): int
    {
        return $this->getPercentOfTotalAmount($this->getUnreadAmount());
    }

    private function getPercentOfTotalAmount(int $value): int
    {
        if (! $this->getTotalAmount()) {
            return 0;
        }

        return $value / $this->getTotalAmount();
    }
}