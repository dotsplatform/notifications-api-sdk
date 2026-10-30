# Review: campaign failure reason (notifications-api-sdk)

## What changed
- `Campaign::STATUS_FAILED = 50` and `Campaign::isFailed()` — the notifications service
  (branch `feature-marketing-optout`) now sets status 50 when a push campaign could not be sent.
- `Campaign::$failureReason` (`?string`, default `null`) + `getFailureReason()`.
  The value comes from the `failureReason` key of the campaign API response; when the key is
  absent (older notifications service, or a campaign that did not fail) it stays `null`.
- New `CampaignFailureReason` class with the 3 known codes
  (`marketing_exclude_list_unavailable`, `marketing_exclude_list_expired`, `send_failed`, `account_not_found`, `invalid_settings`),
  `all()` and `isKnown()`. Plain string constants, not an enum, so an unknown code from a newer
  service never breaks mapping — callers should show a generic text for unknown codes.

## Backward compatibility
- No constructor / method signature changes. `Campaign` is built via `fromArray()`, the new
  property has a default, so existing callers and fixtures without `failureReason` keep working.
- `Campaign::toArray()` now contains a `failureReason` key (null for most campaigns).

## Database / migrations
- None (SDK only).

## Risks
- Low. The repo has no automated test suite; the change was checked with a smoke script
  (`fromArray` with/without `failureReason`, unknown keys ignored) and phpstan level 6.

## Performance
- None — no I/O added.

## Release
- Suggested next version: `v2.7.0` (new backward-compatible API). Tag is created by the owner.
