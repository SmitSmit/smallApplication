<?php
namespace App\Core\Factory;

use Error;
use App\Controller\BaseController;
use App\Core\Settings\BaseSettings;
use App\Core\Request\BaseRequest;

class Router
{
    /** @var BaseSettings */
    private $settings;

    /** @var BaseRequest */
    private $request;

    /** @var string */
    private $uri;

    private const CONTROLLER_NAMESPACE = '\App\Controller\\';

    private const POSTFIX_CONTROLLER = 'Controller';

    private const POSTFIX_ACTION = 'Action';

    public const DEFAULT_CONTROLLER_NAME = 'Index';

    public const DEFAULT_ACTION_NAME = 'index';

    /**
     * @param BaseSettings $settings
     * @param BaseRequest $request
     * @param string $uri
     */
    public function __construct(BaseSettings $settings, BaseRequest $request, string $uri)
    {
        $this->settings = $settings;
        $this->request = $request;
        $this->uri = $uri;
    }

    /**
     * @return BaseController
     * @throws \Throwable
     */
    public function getController(): BaseController
    {
        $controllerName = self::CONTROLLER_NAMESPACE . $this->getControllerNameWithPostfix();

        try {
            $controller = new $controllerName(
                $this->settings,
                $this->request
            );
        } catch (Error $error) {
            throw $error;
        }

        return $controller;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        $data = $this->getUriAsArray();

        if (!empty($data[1])) {
            $extensionPosition = strpos($data[1], '.');
            $length = $extensionPosition !== false ? $extensionPosition :  strlen($data[1]);

            $actionName = substr($data[1], 0, $length);
        } else {
            $actionName = self::DEFAULT_ACTION_NAME;
        }

        return $actionName;
    }

    /**
     * @return string
     */
    public function getActionNameWithPostfix(): string
    {
        return $this->getActionName() .  self::POSTFIX_ACTION;
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        $data = $this->getUriAsArray();

        $controllerName = (string) $data[0] ?: self::DEFAULT_CONTROLLER_NAME;

        return $controllerName ;
    }

    /**
     * @return string
     */
    public function getControllerNameWithPostfix(): string
    {
        return $this->getControllerName() . self::POSTFIX_CONTROLLER;
    }

    /**
     * @param string $controllerTemplate
     * @return string
     */
    public function getTemplateName(string $controllerTemplate): string
    {
        return $controllerTemplate ?:
            $this->getControllerName() . DIRECTORY_SEPARATOR . $this->getActionName();
    }

    /**
     * @return array
     */
    private function getUriAsArray(): array
    {
        return explode('/', trim($this->uri, '/'));
    }
}
