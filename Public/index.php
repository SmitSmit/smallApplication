<?php

use App\SmallApplication;
use App\Core\Request\BaseRequest;

if (preg_match('/([^.]|\/|\.(?:html|php))$/', $_SERVER["REQUEST_URI"])) {
    require_once __DIR__ . '/../App/Boot.php';
    $baseRequest = BaseRequest::getInstanceFromGlobals();
    $application = new SmallApplication();
    $response = $application->processRequest($baseRequest);
    $response->render();
}
