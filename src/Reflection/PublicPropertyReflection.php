<?php declare(strict_types=1);

namespace Maho\PHPStanPlugin\Reflection;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Type;

final class PublicPropertyReflection implements PropertyReflection
{
    public function __construct(private PropertyReflection $originalProperty)
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
}
