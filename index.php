<?php

require_once "./vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;


class Test extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function __construct()
    {
        parent::__construct();

        $instance = DependencyContainer::createInstance();
        $instance->register(Foo::class, function () {
            $foo = new Foo();

            $mock = Mockery::mock($foo);
            $mock->shouldReceive('bar')->andReturn('Wherever you go, there you are.');

            return $mock;
        });
    }

    public function testFoo()
    {
        $mock = \Mockery::mock(Foo::class);
        $mock->shouldReceive('bar')->andReturn('Wherever you go, there you are.');

        ob_start();

        $result = require_once "./main.php";

        $res = ob_get_clean();

        echo $res;
        $this->assertStringContainsString("Wherever you go, there you are.", $res, "Not good.");
    }
}



