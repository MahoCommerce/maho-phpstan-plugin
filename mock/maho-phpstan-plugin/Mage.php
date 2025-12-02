<?php declare(strict_types=1);

/**
 * Maho base path constant - defined at runtime by Maho bootstrap
 */
const BP = '';

/**
 * Main Mage hub class
 */
final class Mage
{
    /**
     * Get initialized application object.
     *
     * @param string|array<string, mixed> $options
     * @return Mage_Core_Model_App
     */
    public static function app(string $code = '', string $type = 'store', $options = [])
    {
    }

    /**
     * @param array<string, mixed> $options
     * @param string|array<int, string> $modules
     */
    public static function init(string $code = '', string $type = 'store', array $options = [], $modules = []): void
    {
    }
}

/**
 * Application model
 */
class Mage_Core_Model_App
{
    /**
     * Retrieve configuration object
     *
     * @return Mage_Core_Model_Config
     */
    public function getConfig()
    {
    }
}

/**
 * Core configuration class
 */
class Mage_Core_Model_Config
{
    /**
     * Retrieve class name from config.xml node
     *
     * @return string
     */
    public function getNodeClassName(string $path)
    {
    }

    /**
     * Retrieve block class name
     *
     * @return string
     */
    public function getBlockClassName(string $blockType)
    {
    }

    /**
     * Retrieve helper class name
     *
     * @return string
     */
    public function getHelperClassName(string $helperAlias)
    {
    }

    /**
     * Retrieve model class name
     *
     * @return string
     */
    public function getModelClassName(string $modelAlias)
    {
    }

    /**
     * Retrieve resource model class name
     *
     * @return string|false
     */
    public function getResourceModelClassName(string $modelAlias)
    {
    }

    /**
     * Retrieve resource helper class name
     *
     * @return string|false
     */
    public function getResourceHelperClassName(string $moduleAlias)
    {
    }
}

/**
 * Varien Object (legacy)
 * @implements ArrayAccess<string, mixed>
 */
class Varien_Object implements ArrayAccess, JsonSerializable
{
    public function offsetExists(mixed $offset): bool {}
    public function offsetGet(mixed $offset): mixed {}
    public function offsetSet(mixed $offset, mixed $value): void {}
    public function offsetUnset(mixed $offset): void {}
    public function jsonSerialize(): mixed {}
}
