<?php
declare(strict_types=1);

namespace PHPStanMagento1\Type\Mage\CoreModelLayout;

final class GetBlockSingleton extends MethodReturnTypeDetector
{
    public function getMagentoClassName(string $identifier): string
    {
        return $this->getMagentoConfig()->getBlockClassName($identifier);
    }

    protected static function getMethodName(): string
    {
        return 'getBlockSingleton';
    }
}