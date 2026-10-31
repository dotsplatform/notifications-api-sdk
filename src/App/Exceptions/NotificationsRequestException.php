<?php
/**
 * Description of NotificationsRequestException.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Exceptions;

use RuntimeException;

/**
 * The notifications service is not reachable or did not answer with a success.
 * Thrown by the push opens client, so the caller can tell "no data" from "service down".
 */
class NotificationsRequestException extends RuntimeException
{
}
