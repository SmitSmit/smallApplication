<?php
namespace App\Service\Referral\Repository;

use PDOException;
use App\Service\Referral\Repository\Model\PromotionCodeModel;
use App\Service\Referral\Repository\Model\UserPromotionCodeModel;

class Repository
{
    /*
     * В рамках данного приложения ввиду того, что хоть настройки для таблицы `promocode` и
     * таблицы `user_promocode` могут находится в разных бд (по хосту, по имени и т.д) чтобы
     * легко шардироваться при больших нагрузках (для этого необходимо также писать запросы к каждой
     *  "шардированной" таблице в отдельности)
     *
     * Однако вввиду поставленной задачи мы будем максимально использовать индексы табли
     * ц и выполнять работу на строне mysql, а не PHP
     * Запросы написаны без ORM;
     */

    /**
     * @param string $userId
     * @return string|null
     */
    public function getUserPromotionCode(string $userId):? string
    {
        try {
            $promotionModel = new PromotionCodeModel();


            $pdo = $promotionModel->getConnection();

            $query = 'select p.promocode from promocode p JOIN user_promocode up
where p.id = up.promocode_id and up.user_id = ? ';

            $pdoStatement = $pdo->prepare($query);

            $pdoStatement->execute([$userId]);

            $promocode = (string) $pdoStatement->fetchColumn();

            $pdoStatement->closeCursor();
        } catch (PDOException $exception) {
            throw $exception;
        }

        return $promocode;
    }

    /**
     * @return PromotionCodeModel
     */
    public function getAvailablePromoCode(): PromotionCodeModel
    {
        try {
            $promotionModel = new PromotionCodeModel();

            $pdo = $promotionModel->getConnection();

            $query = 'SELECT p.id, p.promocode
                      FROM promocode p
                      LEFT JOIN user_promocode up
                      ON p.id = up.promocode_id
                     where up.id is NULL
                    LIMIT 1' ;

            $pdoStatement = $pdo->prepare($query);

            $pdoStatement->execute();

            foreach ($pdoStatement as $result) {
                $promotionModel->setId($result['id']);
                $promotionModel->setPromocode($result['promocode']);
            }

            $pdoStatement->closeCursor();
        } catch (PDOException $exception) {
            throw $exception;
        }

        return $promotionModel;
    }

    /**
     * @param string $userId
     * @param int $promocodeId
     * @return bool
     */
    public function addRecordToUserPromoTable(string $userId, int $promocodeId): bool
    {
        try {
            $userPromotionModel = new UserPromotionCodeModel();

            $pdo = $userPromotionModel->getConnection();

            $query = "INSERT INTO " . $userPromotionModel->getTableName() . " (user_id, promocode_id) VALUES (?,?)";

            $pdoStatement = $pdo->prepare($query);
            $result = $pdoStatement->execute([$userId, $promocodeId]);
            $pdoStatement->closeCursor();

            return $result !== false;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    /**
     * @param string $promocode
     * @return bool
     */
    public function addRecordToPromoTable(string $promocode): bool
    {
        try {
            $promotionModel = new promotionCodeModel();

            $pdo = $promotionModel->getConnection();

            $query = 'INSERT INTO ' . $promotionModel->getTableName() . ' (promocode) VALUES (?)' ;

            $pdoStatement = $pdo->prepare($query);
            $result = $pdoStatement->execute([$promocode]);
            $pdoStatement->closeCursor();
        } catch (PDOException $exception) {
            throw $exception;
        }

        return $result === false;
    }
}
