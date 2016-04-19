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
            'date' => $this->integer()->notNull() . ' COMMENT "Дата в unixtime"',
        ]);

        $this->createIndex('currency_valute_code_date_idx', 'currency', [
            'char_code', 'date'
        ], true);
    }

    public function down()
    {
        $this->dropTable('currency');
    }
}
