<?php
/**
 * Description of PushNotificationResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO\Response;

use Dots\Data\DTO;

class PushNotificationResponseDTO extends DTO
{
    public const READ_YES = 1;
    public const READ_NO = 0;

    protected string $id;
    protected string $title;
    protected string $text;
    protected ?string $image;
    protected int $sent_at;
    protected int $read;
    protected ?array $pushNotificationActionData;
    protected array $linkData;

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getSentAt(): int
    {
        return $this->sent_at;
    }

    public function getRead(): int
    {
        return $this->read;
    }

    public function getPushNotificationActionData(): ?array
    {
        return $this->pushNotificationActionData;
    }

    public function getLinkData(): array
    {
        return $this->linkData;
    }
}
