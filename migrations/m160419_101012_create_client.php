<?php

use yii\db\Migration;

class m160419_101012_create_client extends Migration
{
    public function up()
    {
        $this->createTable('client', [
            'id' => $this->primaryKey(),
            'name' => $this->string(127)->notNull() . ' COMMENT "Имя клиента"',
            'balance' => $this->money()->notNull() . ' COMMENT "Баланс руб."',
        ]);
    }

    public function down()
    {
        $this->dropTable('client');
    }
}
