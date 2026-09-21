<?php

declare(strict_types=1);

namespace Maho\PHPStanPlugin\Analyser;

use PhpParser\Node;
use PHPStan\Analyser\Error;
use PHPStan\Analyser\IgnoreErrorExtension;
use PHPStan\Analyser\Scope;

/**
 * Drop every error reported inside deprecated code.
 *
 * A class tagged @deprecated is on its way out, so its body is not worth a
 * baseline entry. The same goes for a template or install script whose
 * `$this` is bound to a deprecated class, since a template has no class of
 * its own to carry the tag.
 */
final class DeprecatedScopeIgnoreErrorExtension implements IgnoreErrorExtension
{
    public function __construct(
        private readonly bool $ignoreErrorsInDeprecatedScope,
    ) {}

    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        if (!$this->ignoreErrorsInDeprecatedScope) {
            return false;
        }

        $class = $scope->getClassReflection();
        if ($class !== null) {
            return $class->isDeprecated();
        }

        if (!$scope->hasVariableType('this')->yes()) {
            return false;
        }

        return array_any(
            $scope->getVariableType('this')->getObjectClassReflections(),
            fn($reflection) => $reflection->isDeprecated(),
        );
    }
}
