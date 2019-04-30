<?php

namespace App\Controller;

use App\Core\Request\BaseRequest;
use App\Core\Settings\BaseSettings;

abstract class BaseController
{
    /** @var BaseSettings */
    private $settings;

    /** @var BaseRequest */
    private $request;

    /** @var array */
    private $renderVars = [];

    /**
     * @var null
     */
    private $template = null;

    /**
     * BaseController constructor.
     * @param BaseSettings $settings
     * @param BaseRequest $request
     */
    public function __construct(BaseSettings $settings, BaseRequest $request)
    {
        $this->settings = $settings;
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function getRenderVars(): array
    {
        return $this->renderVars;
    }

    /**
     * @return BaseSettings
     */
    public function getSettings(): BaseSettings
    {
        return $this->settings;
    }

    /**
     * @param string $url
     * @return mixed
     */
    public function redirect(string $url)
    {
        header('Location: ' . $url, true, 303);
        exit;
    }

    /**
     * @return string
     */
    public function getTemplateName(): string
    {
        return (string) $this->template;
    }

    /**
     * @param string $keyVar
     * @param string $nameVar
     */
    protected function setRenderVar(string $keyVar, string $nameVar):void
    {
        $this->renderVars[$keyVar] = $nameVar;
    }

    /**
     * @param array $vars
     */
    protected function setRenderVars(array $vars): void
    {
        $this->renderVars = array_merge($this->renderVars, $vars);
    }

    /**
     * @param string $templateName
     */
    protected function setTemplateName(string $templateName): void
    {
        $this->template = $templateName;
    }

    /**
     * @return BaseRequest
     */
    protected function getRequest()
    {
        return $this->request;
    }
}
