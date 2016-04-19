<?php

namespace app\commands;

use app\models\Client;
use yii\console\Controller;

class WorkController extends Controller
{
    public function actionIndex()
    {
        $client = new Client();
        $client->name = 'client test name';
        $client->balance = intval(rand(1000, 99000));
        $client->save();

        $usd = $client->getFormatedPrice('USD');
        echo 'usd - ' . $usd->getPrice(true) . "\n";
        $rub = $client->getFormatedPrice('RUB');
        echo 'rub - ' . $rub->getPrice(true);
    }
}
