# Review — push-opens (branch `feature-push-opens`, base `main`)

Needs the notifications service branch `feature-push-opens` deployed first (new endpoints). No tag yet — the owner
tags after review.

## What changed
- `SendUserNotificationDTO::$externalReference` and `PushNotificationDataDTO::$externalReference` (optional, max 64):
  the caller's send reference (CRM broadcast / message token). The service stores it on every push row and counts
  opens by it. Old service versions ignore the key.
- New interface `Dotsplatform\Notifications\PushOpensClient` (bound to `Clients\PushOpensHttpClient` in the service
  provider), stub `Clients\SuccessPushOpensStubClient`:
  - `markNotificationOpened(accountId, appTokenId, notificationId): ?NotificationOpenDTO` — for clients-api;
  - `getCampaignRecipients(CampaignRecipientsRequestDTO): ?CampaignRecipientsPage` — keyset paging;
  - `getCampaignPushOpens(accountId, campaignId): ?CampaignPushOpensDTO`;
  - `getPushOpensByExternalReferences(accountId, string[] up to 100): ExternalReferencePushOpensList`.
  `null` = 404 (not found in this account). Failures throw `Exceptions\NotificationsRequestException` (unlike
  `NotificationsClient`, which swallows errors).
- DTOs in `DTO/Request/CampaignRecipientsRequestDTO`, `DTO/Response/PushOpens/*`.

## Breaking changes
None. `NotificationsClient` is unchanged on purpose: livesite has a stub that implements it, a new interface method
would break livesite's tests on the bump.

## Checks
- The SDK has no test suite. Checked with a scratch script (Guzzle MockHandler): URLs, query, 404 → null, 500 and
  connection errors → exception, 101 references → InvalidArgumentException, DTO keys — 16/16 OK.
- The SDK's own phpstan 1.x crashes on PHP 8.5 (also on `main`); the sources pass phpstan 2.1 level 6.

## Performance
No database code. One HTTP call per method; the caller pages recipients (default 1000, max 5000 per page).
