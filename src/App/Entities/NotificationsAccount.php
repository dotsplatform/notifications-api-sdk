<?php
/**
 * Description of Account.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Entities;

use Dots\Data\Entity;

class NotificationsAccount extends Entity
{
    protected string $id;
    protected string $name;
    protected string $lang;
    protected ?array $data;

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function getData(): ?array
    {
        return $this->data;
    }
}
