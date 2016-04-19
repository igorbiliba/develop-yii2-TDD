<?php

use yii\db\Migration;

class m160419_100053_create_currency extends Migration
{
    public function up()
    {
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'valute_id' => $this->string(16)->notNull() . ' COMMENT "Ид валюты"',
            'num_code' => $this->string(16) . ' COMMENT "Цифровой код"',
            'char_code' => $this->string(16) . ' COMMENT "Символьный код"',
            'nominal' => $this->integer() . ' COMMENT "Номинал"',
            'name' => $this->string(64) . ' COMMENT "Название"',
            'value' => $this->money() . ' COMMENT "Значение"',
            'date' => $this->timestamp(),
        ]);
    }

    public function down()
    {
        $this->dropTable('currency');
    }
}
