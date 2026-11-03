<?php

declare(strict_types=1);

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
    public function __construct(private ExtendedMethodReflection $originalMethod) {}

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
        return $this->originalMethod->getDocComment();
    }

    #[\Override]
    public function getName(): string
    {
        return $this->originalMethod->getName();
    }

    #[\Override]
    public function getPrototype(): ClassMemberReflection
    {
        return $this->originalMethod->getPrototype();
    }

    /**
     * @return list<\PHPStan\Reflection\ExtendedParametersAcceptor>
     */
    #[\Override]
    public function getVariants(): array
    {
        return $this->originalMethod->getVariants();
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

    #[\Override]
    public function acceptsNamedArguments(): TrinaryLogic
    {
        return $this->originalMethod->acceptsNamedArguments();
    }

    #[\Override]
    public function getAsserts(): Assertions
    {
        return $this->originalMethod->getAsserts();
    }

    #[\Override]
    public function getSelfOutType(): ?Type
    {
        return $this->originalMethod->getSelfOutType();
    }

    #[\Override]
    public function isAbstract(): TrinaryLogic
    {
        $result = $this->originalMethod->isAbstract();
        return $result instanceof TrinaryLogic ? $result : TrinaryLogic::createFromBoolean($result);
    }

    #[\Override]
    public function getNamedArgumentsVariants(): ?array
    {
        return $this->originalMethod->getNamedArgumentsVariants();
    }

    #[\Override]
    public function getOnlyVariant(): \PHPStan\Reflection\ExtendedParametersAcceptor
    {
        $variants = $this->getVariants();
        if (count($variants) !== 1) {
            throw new \PHPStan\ShouldNotHappenException('Expected exactly one variant, got ' . count($variants));
        }
        return $variants[0];
    }

    #[\Override]
    public function isFinalByKeyword(): TrinaryLogic
    {
        return $this->originalMethod->isFinalByKeyword();
    }

    #[\Override]
    public function returnsByReference(): TrinaryLogic
    {
        return $this->originalMethod->returnsByReference();
    }

    #[\Override]
    public function isBuiltin(): bool
    {
        $result = $this->originalMethod->isBuiltin();
        return $result instanceof TrinaryLogic ? $result->yes() : $result;
    }

    #[\Override]
    public function mustUseReturnValue(): TrinaryLogic
    {
        return $this->originalMethod->mustUseReturnValue();
    }

    #[\Override]
    public function isPure(): TrinaryLogic
    {
        return $this->originalMethod->isPure();
    }

    /**
     * @return array<string, TrinaryLogic>
     */
    #[\Override]
    public function getPureUnlessCallableIsImpureParameters(): array
    {
        return $this->originalMethod->getPureUnlessCallableIsImpureParameters();
    }

    /**
     * @return array<string, TrinaryLogic>
     */
    #[\Override]
    public function getPureUnlessParameterPassedParameters(): array
    {
        return $this->originalMethod->getPureUnlessParameterPassedParameters();
    }

    /**
     * @return list<\PHPStan\Reflection\AttributeReflection>
     */
    #[\Override]
    public function getAttributes(): array
    {
        return $this->originalMethod->getAttributes();
    }

    #[\Override]
    public function getResolvedPhpDoc(): ?ResolvedPhpDocBlock
    {
        return $this->originalMethod->getResolvedPhpDoc();
    }
}
