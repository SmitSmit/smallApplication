<?php

namespace App\Core\Model\Base;

use App\Core\Settings\BaseSettings;
use App\Core\Settings\DefaultSettings;

abstract class MySqlModel extends Base
{
    /**
     * @var BaseSettings|null
     */
    private $settings;

    private const DRIVER_NAME = 'mysql';

    private const DEFAULT_CHARSET = 'utf8';

    private const DEFAULT_PORT = '3306';

    /**
     * @param BaseSettings|null $settings
     */
    public function __construct(BaseSettings $settings = null)
    {
        $this->settings = $settings ?? DefaultSettings::getInstance();
    }

    protected function getType(): string
    {
        return self::DRIVER_NAME;
    }

    /**
     * @inheritdoc
     */
    public function getDbName(): string
    {
        $connectionName = $this->getConnectionName();
        return (string) $this->settings->getSetting($connectionName, BaseSettings::DATABASE_NAME_KEY);
    }

    /**
     * @inheritdoc
     */
    protected function getHost(): string
    {
        $connectionName = $this->getConnectionName();

        return (string) $this->settings->getSetting($connectionName, BaseSettings::HOST_KEY);
    }

    /**
     * @inheritdoc
     */
    protected function getPort(): string
    {
        $connectionName = $this->getConnectionName();
        return (string) $this->settings->getSetting($connectionName, BaseSettings::PORT_KEY) ?? self::DEFAULT_PORT;
    }

    /**
     * @inheritdoc
     */
    protected function getDbPassword(): string
    {
        $connectionName = $this->getConnectionName();
        return (string) $this->settings->getSetting($connectionName, BaseSettings::PASSWORD_KEY);
    }

    /**
     * @inheritdoc
     */
    protected function getDbUserName(): string
    {
        $connectionName = $this->getConnectionName();
        return (string) $this->settings->getSetting($connectionName, BaseSettings::USERNAME_KEY);
    }

    /**
     * @inheritdoc
     */
    protected function getCharset(): string
    {
        return self::DEFAULT_CHARSET;
    }

    /**
     * @return string
     */
    abstract public function getTableName(): string;

    /**
     * @return string
     */
    abstract protected function getConnectionName(): string;
}
