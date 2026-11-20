<?php
/**
 * Description of CampaignRecipientsRequestDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO\Request;

use Dots\Data\DTO;

class CampaignRecipientsRequestDTO extends DTO
{
    public const int DEFAULT_LIMIT = 1000;
    public const int MAX_LIMIT = 5000;

    protected string $accountId;

    protected string $campaignId;

    /** `nextAfterId` of the previous page, null for the first page. */
    protected ?string $afterId = null;

    protected int $limit = self::DEFAULT_LIMIT;

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getCampaignId(): string
    {
        return $this->campaignId;
    }

    public function getAfterId(): ?string
    {
        return $this->afterId;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return array<string, string|int>
     */
    public function toQuery(): array
    {
        $query = [
            'limit' => $this->limit,
        ];
        if ($this->afterId !== null) {
            $query['afterId'] = $this->afterId;
        }

        return $query;
    }
}
