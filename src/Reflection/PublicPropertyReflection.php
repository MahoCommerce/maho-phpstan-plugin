<?php

declare(strict_types=1);

namespace Maho\PHPStanPlugin\Reflection;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ExtendedPropertyReflection;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Type;

/**
 * Wrapper that exposes protected/private properties as public.
 *
 * Note: This class implements PHPStan\Reflection\ExtendedPropertyReflection which is not
 * covered by PHPStan's backward compatibility promise. This is necessary for PHPStan
 * extension development and is an accepted trade-off for this plugin.
 *
 * @phpstan-ignore phpstanApi.interface
 */
final class PublicPropertyReflection implements ExtendedPropertyReflection
{
    public function __construct(private ExtendedPropertyReflection $originalProperty) {}

    #[\Override]
    public function getDeclaringClass(): ClassReflection
    {
        return $this->originalProperty->getDeclaringClass();
    }

    #[\Override]
    public function isStatic(): bool
    {
        return $this->originalProperty->isStatic();
    }

    #[\Override]
    public function isPrivate(): bool
    {
        return false;
    }

    #[\Override]
    public function isPublic(): bool
    {
        return true;
    }

    #[\Override]
    public function getDocComment(): ?string
    {
        return $this->originalProperty->getDocComment();
    }

    #[\Override]
    public function getName(): string
    {
        return $this->originalProperty->getName();
    }

    #[\Override]
    public function getReadableType(): Type
    {
        return $this->originalProperty->getReadableType();
    }

    #[\Override]
    public function getWritableType(): Type
    {
        return $this->originalProperty->getWritableType();
    }

    #[\Override]
    public function canChangeTypeAfterAssignment(): bool
    {
        return $this->originalProperty->canChangeTypeAfterAssignment();
    }

    #[\Override]
    public function isReadable(): bool
    {
        return $this->originalProperty->isReadable();
    }

    #[\Override]
    public function isWritable(): bool
    {
        return $this->originalProperty->isWritable();
    }

    #[\Override]
    public function isDeprecated(): TrinaryLogic
    {
        return $this->originalProperty->isDeprecated();
    }

    #[\Override]
    public function getDeprecatedDescription(): ?string
    {
        return $this->originalProperty->getDeprecatedDescription();
    }

    #[\Override]
    public function isInternal(): TrinaryLogic
    {
        return $this->originalProperty->isInternal();
    }

    #[\Override]
    public function getNativeType(): Type
    {
        return $this->originalProperty->getNativeType();
    }

    #[\Override]
    public function hasNativeType(): bool
    {
        return $this->originalProperty->hasNativeType();
    }

    #[\Override]
    public function getPhpDocType(): Type
    {
        return $this->originalProperty->getPhpDocType();
    }

    #[\Override]
    public function hasPhpDocType(): bool
    {
        return $this->originalProperty->hasPhpDocType();
    }

    #[\Override]
    public function isAbstract(): TrinaryLogic
    {
        return $this->originalProperty->isAbstract();
    }

    #[\Override]
    public function isFinal(): TrinaryLogic
    {
        return $this->originalProperty->isFinal();
    }

    #[\Override]
    public function isFinalByKeyword(): TrinaryLogic
    {
        return $this->originalProperty->isFinalByKeyword();
    }

    #[\Override]
    public function isVirtual(): TrinaryLogic
    {
        return $this->originalProperty->isVirtual();
    }

    #[\Override]
    public function isDummy(): TrinaryLogic
    {
        return $this->originalProperty->isDummy();
    }

    #[\Override]
    public function isPrivateSet(): bool
    {
        return false;
    }

    #[\Override]
    public function isProtectedSet(): bool
    {
        return false;
    }

    #[\Override]
    public function hasHook(string $hookType): bool
    {
        return $this->originalProperty->hasHook($hookType);
    }

    #[\Override]
    public function getHook(string $hookType): \PHPStan\Reflection\ExtendedMethodReflection
    {
        return $this->originalProperty->getHook($hookType);
    }

    /**
     * @return list<\PHPStan\Reflection\AttributeReflection>
     */
    #[\Override]
    public function getAttributes(): array
    {
        return $this->originalProperty->getAttributes();
    }
}
