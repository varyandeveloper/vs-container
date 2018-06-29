<?php

namespace VS\Container;

use VS\General\DIFactory;
use VS\General\Exceptions\ClassNotFoundException;

/**
 * Class Container
 * @package VS\Framework\Common\Container
 */
final class Container implements ContainerInterface
{
    /**
     * @var array $classToFactory
     */
    public static $classToFactory = [];
    /**
     * @var array $configurations
     */
    protected static $configurations = [];
    /**
     * @var array $classSingletonState
     */
    protected static $classSingletonState = [];
    /**
     * @var array $aliases
     */
    protected static $aliases = [];

    /**
     * @param string $alias
     * @param string $class
     * @return ContainerInterface
     */
    public function registerAlias(string $alias, string $class): ContainerInterface
    {
        class_alias($class, $alias);
        self::$aliases[$alias] = $class;
        return $this;
    }

    /**
     * @param string $class
     * @param null|string $alias
     * @param null|string $accessor
     * @param null|string $factory
     * @return ContainerInterface
     */
    public function registerClass(string $class, ?string $alias = null, ?string $accessor = null, ?string $factory = null): ContainerInterface
    {
        if (null !== $factory) {
            self::$classToFactory[$class] = $factory;
        } else {
            self::$classToFactory[$class] = $class . 'Factory';
        }

        if (null !== $alias) {
            if ($accessor === null) {
                $accessor = $class.'Accessor';
            }

            self::$classToFactory[$alias] = $factory;
            $this->registerAlias($alias, $accessor);
        }

        return $this;
    }

    /**
     * @param string $class
     * @param mixed ...$params
     * @return mixed
     * @throws \ReflectionException
     * @throws ClassNotFoundException
     */
    public function getSingleTone(string $class, ...$params)
    {
        if (empty(self::$classSingletonState[$class])) {
            self::$classSingletonState[$class] = $this->get($class, ...$params);
        }

        return self::$classSingletonState[$class];
    }

    /**
     * @param string $class
     * @param mixed ...$params
     * @return mixed|object
     * @throws \ReflectionException
     * @throws ClassNotFoundException
     */
    public function get(string $class, ...$params)
    {
        if (!empty(self::$classToFactory[$class]) && class_exists(self::$classToFactory[$class])) {
            $object = (new self::$classToFactory[$class](...$params))($this);
        } else {
            $object = DIFactory::injectClass($class, ...$params);
        }

        return $object;
    }

    /**
     * @param string $key
     * @param array $data
     */
    public function registerConfiguration(string $key, array $data)
    {
        self::$configurations[$key] = $data;
    }

    /**
     * @param string $key
     * @return array
     */
    public function getConfiguration(string $key): array
    {
        if (empty(self::$configurations[$key])) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid configuration key %s',
                $key
            ));
        }
        return self::$configurations[$key];
    }

    /**
     * @param string $className
     * @return null|string
     */
    public function getByAlias(string $className): ?string
    {
        return self::$aliases[$className] ?? null;
    }

    /**
     * @param string $className
     * @return bool
     */
    public function has(string $className)
    {
        return isset(self::$classToFactory[$className]);
    }
}
