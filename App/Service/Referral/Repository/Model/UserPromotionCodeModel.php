<?php

namespace App\Service\Referral\Repository\Model;

use App\Core\Model\Base\MySqlModel;
use App\Core\Settings\BaseSettings;

class UserPromotionCodeModel extends MySqlModel
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $user_id;

    /**
     * @var string|null
     */
    private $promocode_id;

    /**
     * @var string
     */
    private $date_created;


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
    public function getUserId():? string
    {
        return $this->user_id ? (string) $this->user_id : null;
    }

    public function setUserId(string $userId)
    {
        $this->user_id = $userId;
    }

    public function getPromocodeId():? string
    {
        return $this->promocode_id ? (string) $this->promocode_id : null;
    }

    /**
     * @return string|null
     */
    public function getCreatedDate():? string
    {
        return $this->date_created ? $this->date_created : null;
    }

    /**
     * @inheritdoc
     */
    protected function getConnectionName(): string
    {
        return BaseSettings::USER_DATABASE_GROUP_KEY;
    }

    /**
     * @inheritdoc
     */
    public function getTableName(): string
    {
        return 'user_promocode';
    }
}
