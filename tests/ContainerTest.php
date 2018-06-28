<?php

class TestUserAccessor extends \VS\Container\ClassAccessor\AbstractClassAccessor {
    /**
     * @return string
     */
    public static function getClass(): string
    {
        return TestUser::class;
    }
}

/**
 * Class ContainerTest
 * @author VArazdat Stepanyan
 */
class ContainerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \VS\Container\ContainerInterface $container
     */
    protected $Container;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->Container = new VS\Container\Container();
    }
}