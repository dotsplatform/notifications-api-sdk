<?php

/**
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO;

use Dots\Data\DTO;

class LiveActivityPushDataDTO extends DTO
{
    public const string EVENT_UPDATE = 'update';
    public const string EVENT_END = 'end';

    public const int DISMISSAL_DELAY_COMPLETED_SECONDS = 900;
    public const int DISMISSAL_DELAY_IMMEDIATE = 0;

    protected string $token;
    protected string $bundleId;
    protected array $contentState;
    protected string $event = self::EVENT_UPDATE;
    protected int $dismissalDelaySeconds = self::DISMISSAL_DELAY_IMMEDIATE;

    public function getToken(): string
    {
        return $this->token;
    }

    public function getBundleId(): string
    {
        return $this->bundleId;
    }

    public function getContentState(): array
    {
        return $this->contentState;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function getDismissalDelaySeconds(): int
    {
        return $this->dismissalDelaySeconds;
    }

    public function isEndEvent(): bool
    {
        return $this->event === self::EVENT_END;
    }
}
