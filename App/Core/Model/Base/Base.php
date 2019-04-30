<?php
namespace App\Core\Model\Base;

use PDO;

abstract class Base
{
    private const DNS_TEMPLATE = '%s:host=%s;port=%s;dbname=%s;charset=%s';

    /** @var PDO[] */
    public static $connections = [];

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        $connectionId = $this->getConnectionId();
        if (!isset(self::$connections[$connectionId])) {
            self::$connections[$connectionId] = new PDO(
                $this->getDns(),
                $this->getDbUserName(),
                $this->getDbPassword()
            );
        }

        return self::$connections[$connectionId];
    }

    /**
     * @return string
     */
    private function getConnectionId(): string
    {
        return $this->getDns() . $this->getDbUserName() . $this->getDbPassword();
    }

    /**
     * @return string
     */
    private function getDns(): string
    {
        return sprintf(
            self::DNS_TEMPLATE,
            $this->getType(),
            $this->getHost(),
            $this->getPort(),
            $this->getDbName(),
            $this->getCharset()
        );
    }

    /**
     * @return string
     */
    abstract public function getDbName(): string;

    /**
     * Return of driver name
     * @return string
     */
    abstract protected function getType(): string;

    /**
     * @return string
     */
    abstract protected function getHost(): string;

    /**
     * @return string
     */
    abstract protected function getPort(): string;

    /**
     * @return string
     */
    abstract protected function getDbUserName(): string;

    /**
     * @return string
     */
    abstract protected function getDbPassword(): string;

    /**
     * @return string
     */
    abstract protected function getCharset(): string;
}
