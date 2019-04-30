<?php

namespace App;

use App\Core\Settings\BaseSettings;
use App\Core\Settings\DefaultSettings;
use App\Core\Request\BaseRequest;
use App\Core\Response\ResponseInterface;

abstract class AbstractApplication
{
    /**
     * @var BaseSettings
     */
    private $settings;

    /**
     * @param BaseSettings|null $settings
     */
    public function __construct(BaseSettings $settings = null)
    {
        $this->settings = $settings ?? DefaultSettings::getInstance();
    }

    /**
     * @return BaseSettings
     */
    protected function getSettings(): BaseSettings
    {
        return $this->settings;
    }

    /**
     * @param BaseRequest $request
     * @return ResponseInterface
     */
    abstract public function processRequest(BaseRequest $request): ResponseInterface;
}
