<?php
/**
 * Description of ExternalReferencePushOpensList.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\Notifications\DTO\Response\PushOpens;

use Illuminate\Support\Collection;

/** @extends Collection<int, ExternalReferencePushOpensDTO> */
class ExternalReferencePushOpensList extends Collection
{
    /**
     * @param array<int, array<string, mixed>> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(array_map(
            fn (array $item) => ExternalReferencePushOpensDTO::fromArray($item),
            $data,
        ));
    }

    public function findByExternalReference(string $externalReference): ?ExternalReferencePushOpensDTO
    {
        foreach ($this->all() as $item) {
            if ($item->getExternalReference() === $externalReference) {
                return $item;
            }
        }

        return null;
    }
}
