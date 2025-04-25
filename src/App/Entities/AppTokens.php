<?php
/**
 * Description of AppTokens.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Mamontov Bogdan <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\Entities;

use Illuminate\Support\Collection;

/**
 * @extends Collection<int|string, AppToken>
 * @method AppToken[] all()
 */
class AppTokens extends Collection
{
    /** @return Collection<string, non-empty-array<int, AppToken>>*/
    public function groupByUsers(): Collection
    {
        $result = [];
        foreach ($this->all() as $item) {
            if (!$item->getUserId()) {
                continue;
            }
            $result[$item->getUserId()][] = $item;
        }

        return collect($result);
    }

    public static function fromArray(array $data): self
    {
        $tokens = array_map(function (array $item) {
            return AppToken::fromArray($item);
        }, $data);

        return new self($tokens);
    }
}
