<?php declare(strict_types=1);

namespace Maho\PHPStanPlugin\Config;

use Mage;
use Mage_Core_Model_Config;

final class MageCoreConfig
{
    private bool $useLocalXml;
    private bool $hasInitialized = false;

    public function __construct(bool $useLocalXml)
    {
        $this->useLocalXml = $useLocalXml;
    }

    public function getConfig(): Mage_Core_Model_Config
    {
        if ($this->hasInitialized === false && $this->useLocalXml === false) {
            $this->hasInitialized = true;
            Mage::init('', 'store', ['is_installed' => false]);
        }
        return Mage::app()->getConfig();
    }

    /**
     * @return ?callable(string): (string|false)
     */
    public function getClassNameConverterFunction(string $class, string $method): ?callable
    {
        return match ("$class::$method") {
            'Mage::getModel',
            'Mage::getSingleton',
            'Mage_Core_Model_Config::getModelInstance',
            'Mage_Core_Model_Factory::getModel',
            'Mage_Core_Model_Factory::getSingleton'
                => fn (string $alias): string => $this->getConfig()->getModelClassName($alias),

            'Mage::getResourceModel',
            'Mage::getResourceSingleton',
            'Mage_Core_Model_Config::getResourceModelInstance',
            'Mage_Core_Model_Factory::getResourceModel'
                => fn (string $alias): string => $this->getConfig()->getResourceModelClassName($alias),

            'Mage::getResourceHelper',
            'Mage_Core_Model_Config::getResourceHelper',
            'Mage_Core_Model_Config::getResourceHelperInstance'
                => fn (string $alias): string => $this->getConfig()->getResourceHelperClassName($alias),

            'Mage::getBlockSingleton',
            'Mage_Core_Block_Abstract::getHelper',
            'Mage_Core_Model_Layout::addBlock',
            'Mage_Core_Model_Layout::createBlock',
            'Mage_Core_Model_Layout::getBlockSingleton'
                => fn (string $alias): string => $this->getConfig()->getBlockClassName($alias),

            'Mage::helper',
            'Mage_Core_Block_Abstract::helper',
            'Mage_Core_Model_Config::getHelperInstance',
            'Mage_Core_Model_Factory::getHelper',
            'Mage_Core_Model_Layout::helper'
                => fn (string $alias): string => $this->getConfig()->getHelperClassName($alias),

            'Mage_Core_Model_Config::getNodeClassInstance'
                => fn (string $path): string => $this->getConfig()->getNodeClassName($path),

            default => null,
        };
    }
}
