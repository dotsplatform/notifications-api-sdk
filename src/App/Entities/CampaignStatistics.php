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

    protected int $totalCount = 0;

    protected int $successCount = 0;

    protected int $failCount = 0;

    protected int $readCount = 0;

    protected int $unreadCount = 0;

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function getSuccessCount(): int
    {
        return $this->successCount;
    }

    public function getFailCount(): int
    {
        return $this->failCount;
    }

    public function getReadCount(): int
    {
        return $this->readCount;
    }

    public function getUnreadCount(): int
    {
        return $this->unreadCount;
    }

    public function getPercentTotalCount(): int
    {
        return $this->getPercentOfTotalCount($this->getTotalCount());
    }

    public function getPercentSuccessCount(): int
    {
        return $this->getPercentOfTotalCount($this->getSuccessCount());
    }

    public function getPercentFailCount(): int
    {
        return $this->getPercentOfTotalCount($this->getFailCount());
    }

    public function getPercentReadCount(): int
    {
        return $this->getPercentOfTotalCount($this->getReadCount());
    }

    public function getPercentUnreadCount(): int
    {
        return $this->getPercentOfTotalCount($this->getUnreadCount());
    }

    private function getPercentOfTotalCount(int $value): int
    {
        if (! $this->getTotalCount()) {
            return 0;
        }

        return ($value / $this->getTotalCount()) * 100;
    }
}