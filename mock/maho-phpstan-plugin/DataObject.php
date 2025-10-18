<?php declare(strict_types=1);

namespace Maho;

/**
 * Maho DataObject (modern replacement for Varien_Object)
 * @implements \ArrayAccess<string, mixed>
 */
class DataObject implements \ArrayAccess, \JsonSerializable
{
    public function offsetExists(mixed $offset): bool {}
    public function offsetGet(mixed $offset): mixed {}
    public function offsetSet(mixed $offset, mixed $value): void {}
    public function offsetUnset(mixed $offset): void {}
    public function jsonSerialize(): mixed {}
}
