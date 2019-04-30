<?php

namespace App\Service\Referral;

use App\Core\Settings\BaseSettings as Settings;
use App\Service\Referral\Repository\Repository;

class ReferralService
{
    private const LINK_TEMPLATE = '%s://%s%s%s';

    /**
     * @param Settings $settings
     * @param string $promocode
     * @return string
     */
    public function getReferralUrl(Settings $settings, string $promocode): string
    {
        $protocol = $settings->getSetting(Settings::REFERRAL_PROGRAM_KEY, Settings::PROTOCOL_KEY);
        $url = $settings->getSetting(Settings::REFERRAL_PROGRAM_KEY, Settings::URL_KEY);
        $urn = $settings->getSetting(Settings::REFERRAL_PROGRAM_KEY, Settings::URN_KEY);

        return sprintf(self::LINK_TEMPLATE, $protocol, $url, $urn, $promocode);
    }

    /**
     * @param string $userId
     * @return string
     */
    public function getPromoCode(string $userId): string
    {
        $repository = new Repository();

        $promoCode = $repository->getUserPromotionCode($userId);

        if (empty($promoCode)) {
            $promoCodeModel = $repository->getAvailablePromoCode();

            if ($promoCodeModel->getId()) {
                if ($repository->addRecordToUserPromoTable($userId, $promoCodeModel->getId())) {
                    $promoCode = (string) $promoCodeModel->getPromocode();
                }
            }
        }

        return $promoCode;
    }
}
