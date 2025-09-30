<?php declare(strict_types=1);

namespace Maho\PHPStanPlugin\Reflection;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\ShouldNotHappenException;
use Varien_Object;
use function in_array;
use function substr;

final class VarienObjectReflectionExtension implements MethodsClassReflectionExtension
{
    public function __construct(private bool $enforceDocBlock, private ReflectionProvider $reflectionProvider)
    {
    }

    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        if (!in_array(substr($methodName, 0, 3), ['get', 'set', 'uns', 'has'], true)) {
            return false;
        }
        if (!$classReflection->is(Varien_Object::class)) {
            return false;
        }

        if (isset($classReflection->getMethodTags()[$methodName])) {
            return false;
        }

        if ($this->enforceDocBlock && $this->reflectionProvider->hasClass(Varien_Object::class)) {
            $varienObjectReflection = $this->reflectionProvider->getClass(Varien_Object::class);
            if ($classReflection->isSubclassOfClass($varienObjectReflection)) {
                return false;
            }
        }

        return true;
    }

    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        $nativeMethod = match (substr($methodName, 0, 3)) {
            'get' => $classReflection->getNativeMethod('getData'),
            'set' => $classReflection->getNativeMethod('setData'),
            'uns' => $classReflection->getNativeMethod('unsetData'),
            'has' => $classReflection->getNativeMethod('hasData'),
            default => throw new ShouldNotHappenException(),
        };

        return new MagicMethodReflection($nativeMethod, $methodName);
    }
}
