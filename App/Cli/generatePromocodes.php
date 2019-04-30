#!/usr/bin/env php
<?php
use App\Service\Referral\Repository\Repository;

require_once __DIR__ . '/../../App/Boot.php';

$rowAmount = 500000;
$showMessageEveryStr = 1000;

$repository = new Repository();

echo 'Start generate' . PHP_EOL . PHP_EOL;

for ($counter = 0; $counter < $rowAmount; $counter++) {
    try {
        $promoCode = strtoupper(bin2hex(random_bytes(5)));
        $repository->addRecordToPromoTable($promoCode);
        if (($counter % $showMessageEveryStr) == 0) {
            echo 'Generated ' . $counter . PHP_EOL;
            echo '_____________' . PHP_EOL;
        }
    } catch (\PDOException $exception) {
        echo $exception->getMessage() . PHP_EOL . PHP_EOL;
    }
}

echo 'Generated!' . PHP_EOL . PHP_EOL;
