<?php
namespace App\Core\Request\Http;

use App\Core\Request\ParametersInterface;

class Server implements ParametersInterface
{
    /**
     * @var array
     */
    protected $server;

    public const REQUEST_URI_KEY = 'REQUEST_URI';

    public function __construct()
    {
        $this->server = $_SERVER;
    }

    /**
     * @inheritdoc
     */
    public function get(string $name): string
    {
        return (string) $this->server[$name] ?? '';
    }

    /**
     * @inheritdoc
     */
    public function set(string $name, string $value): bool
    {
        if (!$this->validate($value)) {
            return false;
        }
        $this->server[$name] = $value;

        return true;
    }

    /**
     * @inheritdoc
     */
    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * @param string $value
     * @return bool
     */
    private function validate(string $value): bool
    {
        return true;
    }
}
