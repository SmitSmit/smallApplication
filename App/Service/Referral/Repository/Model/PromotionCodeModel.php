<?php

namespace App\Service\Referral\Repository\Model;

use App\Core\Model\Base\MySqlModel;
use App\Core\Settings\BaseSettings;

class PromotionCodeModel extends MySqlModel
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $promocode;

    /**
     * @return int|null
     */
    public function getId():? int
    {
        return $this->id ? (int) $this->id : null;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getPromocode():? string
    {
        return $this->promocode ? (string) $this->promocode : null;
    }


    /**
     * @param string $promocode
     */
    public function setPromocode(string $promocode)
    {
        $this->promocode = $promocode;
    }

    /**
     * @inheritdoc
     */
    protected function getConnectionName(): string
    {
        return BaseSettings::PROMO_DATABASE_GROUP_KEY;
    }

    /**
     * @inheritdoc
     */
    public function getTableName(): string
    {
        return 'promocode';
    }
}
