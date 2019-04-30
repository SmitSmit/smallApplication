<?php

namespace App\Core\Settings;

abstract class BaseSettings
{
    /**
     * The group of user database settings
     */
    public const USER_DATABASE_GROUP_KEY = 'USER_DATABASE';

    /**
     * The database promotion settings group
     */
    public const PROMO_DATABASE_GROUP_KEY = 'PROMO_DATABASE';

    /**
     * Key of any host
     */
    public const HOST_KEY = 'host';

    /**
     * Key of any port
     */
    public const PORT_KEY = 'port';

    /**
     * Key of any username
     */
    public const USERNAME_KEY = 'username';

    /**
     * Key of any password
     */
    public const PASSWORD_KEY = 'password';

    /**
     * Key of any databaseName
     */
    public const DATABASE_NAME_KEY = 'databaseName';

    /**
     * Key of referral program group
     */
    public const REFERRAL_PROGRAM_KEY = 'REFERRAL_PROGRAM';

    /**
     *  Key of any protocol
     */
    public const PROTOCOL_KEY = 'protocol';

    /**
     * Key of any url
     */
    public const URL_KEY = 'url';

    /**
     * Key of any urn
     */
    public const URN_KEY = 'urn';

    /**
     * @var BaseSettings[]
     */
    private static $instances = [];


    /**
     * @return BaseSettings
     */
    public static function getInstance(): BaseSettings
    {

        if (!isset(self::$instances[static::class])) {
            $instance = new static();
            $instance->load();
            self::$instances[static::class] = $instance;
        }
        return self::$instances[static::class];
    }

    protected function __construct()
    {
        //Stub for protection
    }

    /**
     * @param string $group
     * @param string $key
     * @return string
     */
    abstract public function getSetting(string $group, string $key): string;

    /**
     * Load settings from source
     */
    abstract protected function load(): void;
}
