<?php

namespace App\Core\Request;

interface ParametersInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function set(string $key, string $value): bool;

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;
}
