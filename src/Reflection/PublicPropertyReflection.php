<?php declare(strict_types=1);

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
    public function __construct(private ExtendedPropertyReflection $originalProperty)
    {
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this->originalProperty->getDeclaringClass();
    }

    public function isStatic(): bool
    {
        return $this->originalProperty->isStatic();
    }

    public function isPrivate(): bool
    {
        return false;
    }

    public function isPublic(): bool
    {
        return true;
    }

    public function getDocComment(): ?string
    {
        return $this->originalProperty->getDocComment();
    }

    public function getName(): string
    {
        return $this->originalProperty->getName();
    }

    public function getReadableType(): Type
    {
        return $this->originalProperty->getReadableType();
    }

    public function getWritableType(): Type
    {
        return $this->originalProperty->getWritableType();
    }

    public function canChangeTypeAfterAssignment(): bool
    {
        return $this->originalProperty->canChangeTypeAfterAssignment();
    }

    public function isReadable(): bool
    {
        return $this->originalProperty->isReadable();
    }

    public function isWritable(): bool
    {
        return $this->originalProperty->isWritable();
    }

    public function isDeprecated(): TrinaryLogic
    {
        return $this->originalProperty->isDeprecated();
    }

    public function getDeprecatedDescription(): ?string
    {
        return $this->originalProperty->getDeprecatedDescription();
    }

    public function isInternal(): TrinaryLogic
    {
        return $this->originalProperty->isInternal();
    }

    public function getNativeType(): Type
    {
        return $this->originalProperty->getNativeType();
    }

    public function hasNativeType(): bool
    {
        return $this->originalProperty->hasNativeType();
    }

    public function getPhpDocType(): Type
    {
        return $this->originalProperty->getPhpDocType();
    }

    public function hasPhpDocType(): bool
    {
        return $this->originalProperty->hasPhpDocType();
    }

    public function isAbstract(): TrinaryLogic
    {
        return $this->originalProperty->isAbstract();
    }

    public function isFinal(): TrinaryLogic
    {
        return $this->originalProperty->isFinal();
    }

    public function isFinalByKeyword(): TrinaryLogic
    {
        return $this->originalProperty->isFinalByKeyword();
    }

    public function isVirtual(): TrinaryLogic
    {
        return $this->originalProperty->isVirtual();
    }

    public function isDummy(): TrinaryLogic
    {
        return $this->originalProperty->isDummy();
    }

    public function isPrivateSet(): bool
    {
        return false;
    }

    public function isProtectedSet(): bool
    {
        return false;
    }

    public function hasHook(string $hookType): bool
    {
        return $this->originalProperty->hasHook($hookType);
    }

    public function getHook(string $hookType): \PHPStan\Reflection\ExtendedMethodReflection
    {
        return $this->originalProperty->getHook($hookType);
    }

    /**
     * @return list<\PHPStan\Reflection\AttributeReflection>
     */
    public function getAttributes(): array
    {
        return $this->originalProperty->getAttributes();
    }
}
