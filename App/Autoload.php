<?php

namespace App;

class Autoload
{
    /** @var string */
    private static $rootPath = __DIR__ . '/../';

    /**
     * @param string $class
     */
    public static function baseLoad(string $class): void
    {
        $className = self::$rootPath . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        self::requireClass($className);
    }

    /**
     * @param string $className
     */
    private static function requireClass(string $className): void
    {
        if (is_file($className)) {
            require_once $className;
        }
    }
}

spl_autoload_register([Autoload::class, 'baseLoad']);
