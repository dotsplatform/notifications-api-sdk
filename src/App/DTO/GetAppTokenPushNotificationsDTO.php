<?php
/**
 * Description of GetAppTokenPushNotificationsDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;

use Dots\Data\DTO;

class GetAppTokenPushNotificationsDTO extends DTO
{
    protected string $accountId;
    protected ?string $userId;
    protected string $appTokenId;
    protected int $limit = 50;
    protected int $offset = 0;

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function getAppTokenId(): string
    {
        return $this->appTokenId;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
