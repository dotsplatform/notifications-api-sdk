<?php
/**
 * Description of StoreNotificationDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;

use Dots\Data\DTO;

class StoreUserPushNotificationDTO extends DTO
{
    public const NOTIFICATION_TYPE_MESSAGE = 'message';
    public const NOTIFICATION_TYPE_DATA = 'data';

    public const SHOW_MESSAGE_NOTIFICATION_IN_ACTIVE_APP_YES = 1;
    public const SHOW_MESSAGE_NOTIFICATION_IN_ACTIVE_APP_NO = 0;
    
    public const ACTION_TYPE_SERVICE = 'service';
    public const ACTION_TYPE_INFO = 'info';
    public const ACTION_TYPE_PROMO = 'promo';

    public const ACTION_REFRESH_USER_ORDERS = 'refresh-user-orders';
    public const ACTION_SHOW_SCREEN = 'show-screen';

    public const LIVE_TIME_SECONDS_DEFAULT = 1200; // 1 hour

    public const SOUND_DEFAULT = 'default';
    public const SOUND_BUSINESS_APP = 'ring3x';

    protected string $accountId;
    protected array $userIds;
    protected array $appTokenTypes;
    protected ?string $orderId;
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

    public function getUserIds(): array
    {
        return $this->userIds;
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

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function getAppTokenTypes(): array
    {
        return $this->appTokenTypes;
    }
}
