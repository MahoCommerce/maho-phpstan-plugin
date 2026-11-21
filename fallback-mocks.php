<?php

declare(strict_types=1);

use Composer\InstalledVersions;

if (class_exists(InstalledVersions::class)
    && method_exists(InstalledVersions::class, 'getInstallPath')
    && InstalledVersions::isInstalled('mahocommerce/maho')
    && InstalledVersions::getInstallPath('mahocommerce/maho') !== null
) {
    return [];
}

return [
    'parameters' => [
        'scanDirectories' => [__DIR__ . '/mock/maho-phpstan-plugin'],
    ],
];
