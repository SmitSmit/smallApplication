<?php
namespace App\Core\Request;

use App\Core\Request\Http;

class BaseRequest
{
    /** @var BaseRequest[] */
    private static $instances = [];

    /** @var ParametersInterface */
    private $cookie;

    /** @var ParametersInterface */
    private $get;

    /** @var ParametersInterface */
    private $post;

    /** @var ParametersInterface */
    private $files;

    /** @var ParametersInterface */
    private $server;

    /** Key for URI */
    public const URI_KEY = 'REQUEST_URI';

    /**
     * @param ParametersInterface $cookie
     * @param ParametersInterface $get
     * @param ParametersInterface $post
     * @param ParametersInterface $files
     * @param ParametersInterface $server
     */
    private function __construct(
        ParametersInterface $cookie,
        ParametersInterface $get,
        ParametersInterface $post,
        ParametersInterface $files,
        ParametersInterface $server
    ) {
        $this->cookie = $cookie;
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
        $this->server = $server;
    }

    /**
     * @return BaseRequest
     */
    public static function getInstanceFromGlobals(): BaseRequest
    {
        self::$instances[__FUNCTION__] = self::$instances[__FUNCTION__] ??
            (new static(
                new Http\Cookie(),
                new Http\Get(),
                new Http\Post(),
                new Http\Files(),
                new Http\Server()
            ));

        return self::$instances[__FUNCTION__];
    }

    /**
     * @return ParametersInterface
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @return ParametersInterface
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @return ParametersInterface
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return ParametersInterface
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return ParametersInterface
     */
    public function getServer()
    {
        return $this->server;
    }
}
