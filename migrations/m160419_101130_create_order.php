<?php

use yii\db\Migration;

class m160419_101130_create_order extends Migration
{
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull() . ' COMMENT "Ссылка на клиента"',
        ]);

        $this->addForeignKey('order_client_fk', 'order', 'client_id', 'client', 'id');
    }

    public function down()
    {
        $this->dropTable('order');
    }
}
