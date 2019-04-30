<?php

namespace App\Controller;

use App\Core\Request\Http\Cookie;
use App\Provider\ServiceProvider;
use App\Service\Referral\ReferralService;
use App\Core\Response\BaseResponse;

class IndexController extends BaseController
{
    public function indexAction()
    {
    }

    public function generatePromoteCodeAction()
    {
        $userId = $this->getRequest()->getCookie()->get(Cookie::USER_ID_KEY);

        /** @var ReferralService $referralService */
        $referralService =  ServiceProvider::getService(ReferralService::class);

        $promoCode = $referralService->getPromoCode($userId);

        if ($promoCode) {
            $this->redirect(
                $referralService->getReferralUrl(
                    $this->getSettings(),
                    $promoCode
                )
            );
        } else {
            $this->setTemplateName(BaseResponse::NOT_FOUND_TEMPLATE);
        }
    }
}
