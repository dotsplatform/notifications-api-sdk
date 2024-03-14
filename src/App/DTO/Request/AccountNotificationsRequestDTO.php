<?php
/**
 * Description of GetNotificationsParamsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO\Request;


use Dots\Data\DTO;

class AccountNotificationsRequestDTO extends DTO
{
    protected string $accountId;
    protected ?array $statuses;
    protected ?int $limit = 50;
    protected ?int $offset = 0;

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getStatuses(): ?array
    {
        return $this->statuses;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }
}