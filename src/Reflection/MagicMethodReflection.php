<?php

declare(strict_types=1);

namespace Maho\PHPStanPlugin\Reflection;

use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\FunctionVariant;
use PHPStan\Reflection\MethodReflection;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Type;

use function array_map;
use function array_slice;

final class MagicMethodReflection implements MethodReflection
{
    public function __construct(private MethodReflection $originalMethod, private string $methodName) {}

    #[\Override]
    public function getDeclaringClass(): ClassReflection
    {
        return $this->originalMethod->getDeclaringClass();
    }

    #[\Override]
    public function isStatic(): bool
    {
        return $this->originalMethod->isStatic();
    }

    #[\Override]
    public function isPrivate(): bool
    {
        return $this->originalMethod->isPrivate();
    }

    #[\Override]
    public function isPublic(): bool
    {
        return $this->originalMethod->isPublic();
    }

    #[\Override]
    public function getDocComment(): ?string
    {
        return $this->originalMethod->getDocComment();
    }

    #[\Override]
    public function getName(): string
    {
        return $this->methodName;
    }

    #[\Override]
    public function getPrototype(): ClassMemberReflection
    {
        return $this->originalMethod->getPrototype();
    }

    /**
     * @return list<FunctionVariant>
     */
    #[\Override]
    public function getVariants(): array
    {
        $variant = $this->originalMethod->getVariants()[0];
        return [
            new FunctionVariant(
                $variant->getTemplateTypeMap(),
                $variant->getResolvedTemplateTypeMap(),
                array_slice($variant->getParameters(), 1),
                $variant->isVariadic(),
                $variant->getReturnType(),
            ),
        ];
    }

    #[\Override]
    public function isDeprecated(): TrinaryLogic
    {
        return $this->originalMethod->isDeprecated();
    }

    #[\Override]
    public function getDeprecatedDescription(): ?string
    {
        return $this->originalMethod->getDeprecatedDescription();
    }

    #[\Override]
    public function isFinal(): TrinaryLogic
    {
        return $this->originalMethod->isFinal();
    }

    #[\Override]
    public function isInternal(): TrinaryLogic
    {
        return $this->originalMethod->isInternal();
    }

    #[\Override]
    public function getThrowType(): ?Type
    {
        return $this->originalMethod->getThrowType();
    }

    #[\Override]
    public function hasSideEffects(): TrinaryLogic
    {
        return $this->originalMethod->hasSideEffects();
    }
}
