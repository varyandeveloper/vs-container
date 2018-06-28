<?php

namespace VS\Container;

/**
 * Interface ContainerInterface
 * @package VS\Framework\Common\Container
 */
interface ContainerInterface
{
    /**
     * @param string $alias
     * @param string $class
     * @return ContainerInterface
     */
    public function registerAlias(string $alias, string $class): ContainerInterface;

    /**
     * @param string $class
     * @param null|string $alias
     * @param null|string $accessor
     * @param null|string $factory
     * @return ContainerInterface
     */
    public function registerClass(string $class, ?string $alias = null, ?string $accessor = null, ?string $factory = null): ContainerInterface;

    /**
     * @param string $class
     * @param mixed ...$params
     * @return mixed
     */
    public function getSingleTone(string $class, ...$params);

    /**
     * @param string $class
     * @param mixed ...$params
     * @return mixed
     */
    public function get(string $class, ...$params);

    /**
     * @param string $key
     * @param array $data
     * @return mixed
     */
    public function registerConfiguration(string $key, array $data);

    /**
     * @param string $key
     * @return mixed
     */
    public function getConfiguration(string $key): array;
}