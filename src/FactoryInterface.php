<?php

namespace VS\Container;

/**
 * Interface FactoryInterface
 * @package VS\Framework\Common
 */
interface FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return mixed
     */
    public function __invoke(ContainerInterface $container);
}