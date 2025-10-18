<?php declare(strict_types=1);

/**
 * Main Mage hub class
 */
final class Mage
{
    /**
     * Get initialized application object.
     *
     * @param string $code
     * @param string $type
     * @param string|array<string, mixed> $options
     * @return Mage_Core_Model_App
     */
    public static function app($code = '', $type = 'store', $options = []): Mage_Core_Model_App
    {
        return new Mage_Core_Model_App();
    }

    /**
     * @static
     * @param string $code
     * @param string $type
     * @param array<string, mixed> $options
     * @param string|array<int, string> $modules
     */
    public static function init($code = '', $type = 'store', $options = [], $modules = []): void
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
    public function getConfig(): Mage_Core_Model_Config
    {
        return new Mage_Core_Model_Config();
    }
}

/**
 * Core configuration class
 */
class Mage_Core_Model_Config
{
    /**
     * Retrieve class name from config.xml node
     */
    public function getNodeClassName(string $path): string
    {
        return '';
    }

    /**
     * Retrieve block class name
     *
     * @param string $blockType
     * @return string
     */
    public function getBlockClassName($blockType): string
    {
        return '';
    }

    /**
     * Retrieve helper class name
     *
     * @param string $helperAlias
     * @return string
     */
    public function getHelperClassName($helperAlias): string
    {
        return '';
    }

    /**
     * Retrieve model class name
     *
     * @param string $modelAlias
     * @return string
     */
    public function getModelClassName($modelAlias): string
    {
        return '';
    }

    /**
     * Retrieve resource model class name
     *
     * @param string $modelAlias
     * @return string|false
     */
    public function getResourceModelClassName($modelAlias): string|false
    {
        return '';
    }

    /**
     * Retrieve resource helper class name
     */
    public function getResourceHelperClassName(string $moduleAlias): string|false
    {
        return '';
    }
}

/**
 * Varien Object (legacy)
 * @implements ArrayAccess<string, mixed>
 */
class Varien_Object implements ArrayAccess, JsonSerializable
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
