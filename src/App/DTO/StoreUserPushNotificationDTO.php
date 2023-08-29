<?php
/**
 * Description of StoreNotificationDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;

use Dots\Data\DTO;
use MA\App\Utils\DTO\NotificationsLinkDTO;

class StoreUserPushNotificationDTO extends DTO
{
    public const SOUND_DEFAULT = 'default';
    public const LIVE_TIME_SECONDS_DEFAULT = 1200;
    public const NOTIFICATION_TYPE_PUSH = 'push';

    public const NOTIFICATION_TYPE_MESSAGE = 'message';
    public const NOTIFICATION_TYPE_DATA = 'data';

    protected string $accountId;
    protected string $userId;
    protected string $notificationType;
    protected string $title;
    protected string $message;
    protected array $data = [];
    protected string $sound = self::SOUND_DEFAULT;
    protected int $liveTime = self::LIVE_TIME_SECONDS_DEFAULT;
    protected ?string $image = null;
    protected ?string $channel = null;
    protected NotificationsLinkDTO $linkData;

    public static function fromArray(array $data): static
    {
        $data['linkData'] = NotificationsLinkDTO::fromArray($data['linkData'] ?? []);
        return parent::fromArray($data);
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getNotificationType(): string
    {
        return $this->notificationType;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getSound(): string
    {
        return $this->sound;
    }

    public function getLiveTime(): int
    {
        return $this->liveTime;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function getLinkData(): NotificationsLinkDTO
    {
        return $this->linkData;
    }
}
