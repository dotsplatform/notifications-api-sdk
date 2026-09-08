# DEV-18603 — send the internal gateway token (notifications-api-sdk)

Branch: `feature-DEV-18603`

## What changed

The SDK now sends `X-Internal-Gateway-Token` on every request, so its consumers
keep working once the `notifications` service starts requiring it.

- `src/App/Clients/NotificationsHttpClient.php` — header constant + the token is read once and put into the client headers
- `src/config/notifications-api-sdk.php` — new `token` key, read from `NOTIFICATIONS_INTERNAL_GATEWAY_TOKEN`

The header constant is declared as an untyped `private const` to stay compatible
with the PHP versions this package still supports.

## Env variable

`NOTIFICATIONS_INTERNAL_GATEWAY_TOKEN` — the same value the `notifications` service is configured with.

## Release

This package must be tagged (minor bump) and the new version pulled into its
consumers: `livesite`, `clients-api`, `notifications`. The existing caret constraints already accept a minor
bump, so only `composer.lock` changes there.

## Database / performance

No database access, no queries, no schema changes.

## Risk

If a consumer is deployed with an old SDK version after the service is closed,
its calls return 401. Release the SDK and update consumers **before** the
service is deployed.
