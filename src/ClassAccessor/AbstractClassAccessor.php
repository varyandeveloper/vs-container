<?php

namespace VS\Container\ClassAccessor;

use VS\Container\Container;

/**
 * Class AbstractClassAccessor
 * @package VS\Container\ClassAccessor
 */
abstract class AbstractClassAccessor implements ClassAccessorInterface
{
    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws \ReflectionException
     * @throws \VS\General\Exceptions\ClassNotFoundException
     */
    public function __call(string $name, array $arguments)
    {
        return static::__callStatic($name, $arguments);
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return mixed
     * @throws \ReflectionException
     * @throws \VS\General\Exceptions\ClassNotFoundException
     */
    public static function __callStatic(string $method, array $arguments)
    {
        $container = new Container();
        $object = $container->get(static::getClass());
        return $object->{$method}(...$arguments);
    }
}