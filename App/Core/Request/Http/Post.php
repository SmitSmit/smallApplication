<?php
namespace App\Core\Request\Http;

use App\Core\Request\ParametersInterface;

class Post implements ParametersInterface
{
    /**
     * @inheritdoc
     */
    public function get(string $key)
    {
        // TODO: Implement get() method.
    }

    /**
     * @inheritdoc
     */
    public function set(string $key, string $value): bool
    {
        // TODO: Implement set() method.
        return true;
    }

    /**
     * @inheritdoc
     */
    public function has(string $key): bool
    {
        // TODO: Implement has() method.
    }
}
