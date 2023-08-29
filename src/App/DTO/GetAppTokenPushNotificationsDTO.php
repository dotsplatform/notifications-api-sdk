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
    protected string $account;
    protected ?string $user;
    protected string $appToken;
    protected int $limit = 50;
    protected int $offset = 0;

    public function getAccount(): string
    {
        return $this->account;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function getAppToken(): string
    {
        return $this->appToken;
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
