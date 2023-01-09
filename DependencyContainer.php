<?php


class DependencyContainer
{
    private static array $instances = [];

    private static $instanceDI = null;

    public function __construct()
    {
        if (self::$instanceDI == null) {
            self::$instanceDI = $this;
        }
    }


    /**
     * @return DependencyContainer|null
     */
    public static function createInstance()
    {
        if (!self::$instanceDI) {
            self::$instanceDI = new static();
        }

        return self::$instanceDI->getInstance();
    }

    /**
     * return instance of current class
     * @return DependencyContainer|null
     */
    public static function getInstance()
    {
        return self::$instanceDI;
    }

    /**
     * @param $name
     * @param $callback
     * @return void
     */
    public function register($name, $callback)
    {
        self::$instances[$name] = $callback;
    }

    /**
     * Get instance of class or creates it
     * @param string $className
     * @param bool $reload
     * @return mixed
     */
    public function get(string $className, bool $reload = false)
    {
        if (self::$instances[$className] instanceof Closure || $reload) {
            self::$instances[$className] = self::$instances[$className]();
        }

        return self::$instances[$className];
    }
}