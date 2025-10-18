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
    /** @var array<string> */
    private const SUPPORTED_BASE_CLASSES = [
        Varien_Object::class,
        'Maho\\DataObject',
    ];

    public function __construct(private bool $enforceDocBlock, private ReflectionProvider $reflectionProvider)
    {
    }

    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        if (!in_array(substr($methodName, 0, 3), ['get', 'set', 'uns', 'has'], true)) {
            return false;
        }

        // Check if class is a subclass of any supported base class
        $isSupportedClass = false;
        foreach (self::SUPPORTED_BASE_CLASSES as $baseClass) {
            if ($classReflection->is($baseClass)) {
                $isSupportedClass = true;
                break;
            }
        }

        if (!$isSupportedClass) {
            return false;
        }

        if (isset($classReflection->getMethodTags()[$methodName])) {
            return false;
        }

        if ($this->enforceDocBlock) {
            foreach (self::SUPPORTED_BASE_CLASSES as $baseClass) {
                if ($this->reflectionProvider->hasClass($baseClass)) {
                    $baseReflection = $this->reflectionProvider->getClass($baseClass);
                    if ($classReflection->isSubclassOfClass($baseReflection)) {
                        return false;
                    }
                }
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
