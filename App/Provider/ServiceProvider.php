<?php
namespace App\Provider;

class ServiceProvider
{
    /** @var array */
    protected static $services = [];

    /**
     * @param string $className
     * @param mixed ...$parameters
     * @return mixed
     */
    public static function getService(string $className, ...$parameters)
    {
        $key = $className . md5(serialize($parameters));

        if (!isset(self::$services[$key])) {
            self::$services[$key] = new $className(...$parameters);
        }
        return self::$services[$key];
    }
}
