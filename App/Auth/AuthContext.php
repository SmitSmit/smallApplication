<?php

namespace App\Auth;

use App\Core\Request\BaseRequest;
use App\Core\Request\Http\Cookie;

class AuthContext
{
    /** @var BaseRequest */
    private $request;

    /**
     * AuthContext constructor.
     * @param BaseRequest $request
     */
    public function __construct(BaseRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getUniqId()
    {
        return bin2hex(random_bytes(5)); //8 bytes
    }

    public function setUniqIdToUser()
    {
        $this->request->getCookie()->set(
            Cookie::USER_ID_KEY,
            $this->getUniqId(),
            Cookie::MAX_TTL
        );
    }

    /**
     * @return BaseRequest
     */
    public function getRequest(): BaseRequest
    {
        return $this->filterRequest();
    }

    /**
     * @return bool
     */
    public function isAuth(): bool
    {
        return (bool) $this->request->getCookie()->get(Cookie::USER_ID_KEY);
    }

    /**
     * @return BaseRequest
     */
    private function filterRequest(): BaseRequest
    {
        //filter by rules
        return $this->request;
    }
}
