<?php declare(strict_types=1);

namespace Maho;

/**
 * Maho DataObject (modern replacement for Varien_Object)
 * @implements \ArrayAccess<string, mixed>
 */
class DataObject implements \ArrayAccess, \JsonSerializable
{
    /**
     * @param mixed $offset
     */
    public function offsetExists($offset): bool
    {
        return false;
    }

    /**
     * @param mixed $offset
     */
    public function offsetGet($offset): mixed
    {
        return null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
    }

    public function jsonSerialize(): mixed
    {
        return [];
    }
}
