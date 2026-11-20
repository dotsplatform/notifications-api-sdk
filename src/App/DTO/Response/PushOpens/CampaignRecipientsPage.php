<?php
/**
 * Description of CampaignRecipientsPage.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO\Response\PushOpens;

class CampaignRecipientsPage
{
    /**
     * @param CampaignRecipientDTO[] $items
     */
    public function __construct(
        private readonly array $items,
        private readonly ?string $nextAfterId,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $items = [];
        $rawItems = $data['items'] ?? [];
        if (!is_array($rawItems)) {
            $rawItems = [];
        }
        foreach ($rawItems as $rawItem) {
            if (!is_array($rawItem)) {
                continue;
            }
            $items[] = CampaignRecipientDTO::fromArray($rawItem);
        }

        $nextAfterId = $data['nextAfterId'] ?? null;
        if (!is_string($nextAfterId)) {
            $nextAfterId = null;
        }

        return new self($items, $nextAfterId);
    }

    /**
     * @return CampaignRecipientDTO[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Pass it as `afterId` for the next page; null when this page is the last one.
     */
    public function getNextAfterId(): ?string
    {
        return $this->nextAfterId;
    }

    public function hasNextPage(): bool
    {
        return $this->nextAfterId !== null;
    }
}
