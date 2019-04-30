<?php
namespace App\Core\Request\Http;

use App\Core\Request\ParametersInterface;

class Cookie implements ParametersInterface
{
    /** @var array */
    private $cookie;

    public const USER_ID_KEY = 'userId';

    public const MAX_TTL = 2147483647;

    public function __construct()
    {
        $this->cookie = $_COOKIE;
    }

    /**
     * @inheritdoc
     */
    public function get(string $key): string
    {
        return (string) $this->cookie[$key] ?? '';
    }

    /**
     * @inheritdoc
     */
    public function set(string $key, string $value, int $timeout = 0, string $path = '/'): bool
    {
        if (!$this->validate($key)) {
            return false;
        }

        setcookie($key, $value, $timeout, $path);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function has(string $key): bool
    {
        return isset($this->cookie[$key]);
    }

    /**
     * @param string $name
     * @return bool
     */
    private function validate(string $name): bool
    {
        //Mock
        return true;
    }
}
