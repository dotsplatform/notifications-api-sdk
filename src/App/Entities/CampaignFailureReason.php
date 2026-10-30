<?php
/**
 * Description of CampaignFailureReason.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Entities;

/**
 * Codes returned by the notifications service in Campaign::getFailureReason().
 * Kept as plain string constants (not an enum) so an unknown code sent by a newer
 * notifications service does not break mapping of the campaign.
 */
class CampaignFailureReason
{
    public const MARKETING_EXCLUDE_LIST_UNAVAILABLE = 'marketing_exclude_list_unavailable';
    public const MARKETING_EXCLUDE_LIST_EXPIRED = 'marketing_exclude_list_expired';
    public const SEND_FAILED = 'send_failed';

    /**
     * @return string[]
     */
    public static function all(): array
    {
        return [
            self::MARKETING_EXCLUDE_LIST_UNAVAILABLE,
            self::MARKETING_EXCLUDE_LIST_EXPIRED,
            self::SEND_FAILED,
        ];
    }

    public static function isKnown(?string $failureReason): bool
    {
        if ($failureReason === null) {
            return false;
        }

        return in_array($failureReason, self::all(), true);
    }
}
