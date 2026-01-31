<?php declare(strict_types=1);

namespace Maho\PHPStanPlugin\Reflection;

use PHPStan\PhpDoc\ResolvedPhpDocBlock;
use PHPStan\Reflection\Assertions;
use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ExtendedMethodReflection;
use PHPStan\Reflection\ParametersAcceptor;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Type;

/**
 * Wrapper that exposes protected/private methods as public.
 *
 * Note: This class implements PHPStan\Reflection\ExtendedMethodReflection which is not
 * covered by PHPStan's backward compatibility promise. This is necessary for PHPStan
 * extension development and is an accepted trade-off for this plugin.
 *
 * @phpstan-ignore phpstanApi.interface
 */
final class PublicMethodReflection implements ExtendedMethodReflection
{
    public function __construct(private ExtendedMethodReflection $originalMethod)
    {
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this->originalMethod->getDeclaringClass();
    }

    public function isStatic(): bool
    {
        return $this->originalMethod->isStatic();
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
        return $this->originalMethod->getDocComment();
    }

    public function getName(): string
    {
        return $this->originalMethod->getName();
    }

    public function getPrototype(): ClassMemberReflection
    {
        return $this->originalMethod->getPrototype();
    }

    /**
     * @return list<\PHPStan\Reflection\ExtendedParametersAcceptor>
     */
    public function getVariants(): array
    {
        return $this->originalMethod->getVariants();
    }

    public function isDeprecated(): TrinaryLogic
    {
        return $this->originalMethod->isDeprecated();
    }

    public function getDeprecatedDescription(): ?string
    {
        return $this->originalMethod->getDeprecatedDescription();
    }

    public function isFinal(): TrinaryLogic
    {
        return $this->originalMethod->isFinal();
    }

    public function isInternal(): TrinaryLogic
    {
        return $this->originalMethod->isInternal();
    }

    public function getThrowType(): ?Type
    {
        return $this->originalMethod->getThrowType();
    }

    public function hasSideEffects(): TrinaryLogic
    {
        return $this->originalMethod->hasSideEffects();
    }

    public function acceptsNamedArguments(): TrinaryLogic
    {
        return $this->originalMethod->acceptsNamedArguments();
    }

    public function getAsserts(): Assertions
    {
        return $this->originalMethod->getAsserts();
    }

    public function getSelfOutType(): ?Type
    {
        return $this->originalMethod->getSelfOutType();
    }

    public function isAbstract(): TrinaryLogic
    {
        $result = $this->originalMethod->isAbstract();
        return $result instanceof TrinaryLogic ? $result : TrinaryLogic::createFromBoolean($result);
    }

    public function getNamedArgumentsVariants(): ?array
    {
        return $this->originalMethod->getNamedArgumentsVariants();
    }

    public function getOnlyVariant(): \PHPStan\Reflection\ExtendedParametersAcceptor
    {
        $variants = $this->getVariants();
        if (count($variants) !== 1) {
            throw new \PHPStan\ShouldNotHappenException('Expected exactly one variant, got ' . count($variants));
        }
        return $variants[0];
    }

    public function isFinalByKeyword(): TrinaryLogic
    {
        return $this->originalMethod->isFinalByKeyword();
    }

    public function returnsByReference(): TrinaryLogic
    {
        return $this->originalMethod->returnsByReference();
    }

    public function isBuiltin(): bool
    {
        $result = $this->originalMethod->isBuiltin();
        return $result instanceof TrinaryLogic ? $result->yes() : $result;
    }

    public function mustUseReturnValue(): TrinaryLogic
    {
        return $this->originalMethod->mustUseReturnValue();
    }

    public function isPure(): TrinaryLogic
    {
        return $this->originalMethod->isPure();
    }

    /**
     * @return list<\PHPStan\Reflection\AttributeReflection>
     */
    public function getAttributes(): array
    {
        return $this->originalMethod->getAttributes();
    }

    public function getResolvedPhpDoc(): ?ResolvedPhpDocBlock
    {
        return $this->originalMethod->getResolvedPhpDoc();
    }
}
