<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $order_id
 * @property integer $count
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'order_id'], 'required'],
            [['product_id', 'order_id', 'count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'order_id' => 'Order ID',
            'count' => 'Count',
        ];
    }
}
