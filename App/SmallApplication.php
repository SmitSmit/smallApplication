<?php

namespace App;

use \Error;
use App\Auth\AuthContext;
use App\Core\Request\BaseRequest;
use App\Core\Response\BaseResponse;
use App\Core\Response\ResponseInterface;
use App\Exception\GameException;
use App\Exception\RouteException;
use App\Core\Request\Http\Server as ServerGlobals;
use App\Core\Factory\Router;

class SmallApplication extends AbstractApplication
{
    private const DEFAULT_URI_NAME = '';

    /**
     * @param BaseRequest $request
     * @return ResponseInterface
     * @throws GameException
     * @throws \Throwable
     */
    public function processRequest(BaseRequest $request): ResponseInterface
    {
        try {
            $uri = $request->getServer()->get(ServerGlobals::REQUEST_URI_KEY);

            $authContext = new AuthContext($request);
            if (!$authContext->isAuth()) {
                $authContext->setUniqIdToUser();
                $uri = self::DEFAULT_URI_NAME;
            }

            try {
                $response = $this->route($request, $uri);
            } catch (Error $e) {
                $response = $this->route($request, self::DEFAULT_URI_NAME);
            }
            return $response;
        } catch (GameException $e) {
            throw $e;
        }
    }

    /**
     * @param BaseRequest $request
     * @param string $uri
     * @return ResponseInterface
     * @throws \RouterException
     * @throws \Throwable
     */
    private function route(BaseRequest $request, string $uri): ResponseInterface
    {
        try {
            $router = new Router($this->getSettings(), $request, $uri);

            $actionName = $router->getActionNameWithPostfix();

            $controller = $router->getController();

            $controller->$actionName();

            $templateName = $router->getTemplateName($controller->getTemplateName());

            return new BaseResponse($templateName, $controller->getRenderVars());

        } catch (RouteException $e) {
            throw $e;
        }
    }
}
