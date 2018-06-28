<?php

namespace VS\Container\ClassAccessor;

/**
 * Interface ClassAccessorInterface
 * @package VS\Container\ClassAccessor
 */
interface ClassAccessorInterface
{
    /**
     * @return string
     */
    public static function getClass(): string;

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments);

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments);
}