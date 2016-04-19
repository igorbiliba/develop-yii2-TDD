<?php

use yii\db\Migration;

class m160419_100758_create_product extends Migration
{
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull() . ' COMMENT "Наименование"',
            'price' => $this->money()->notNull() . ' COMMENT "Стоимость руб."',
        ]);
    }

    public function down()
    {
        $this->dropTable('product');
    }
}
