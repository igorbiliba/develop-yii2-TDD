<?php

use yii\db\Migration;

class m160419_160801_create_load_history_currency extends Migration
{
    public function up()
    {
        $history = new \app\modules\currency\components\parser\migration\LoadHistoryCurrency();
        $history->update();
    }

    public function down()
    {
        return true;
    }
}
