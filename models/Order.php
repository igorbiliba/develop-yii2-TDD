<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $client_id
 *
 * @property Client $client
 */
class Order extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'CurrencyWork' => [
                'class' => 'app\modules\currency\components\currency_flow\behaviors\CurrencyWorkBehavior',
                'nameVariable' => 'sum', //используем магический метод лишь для чтения
            ],
        ];
    }

    /**
     * вернет сумму заказа
     */
    public function getSum() {
        return self::find()
            ->join('INNER', 'order_product', 'order_product.order_id = order.id')
            ->join('INNER', 'product', 'order_product.product_id = product.id')
            ->sum('product.price');
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id'], 'required'],
            [['client_id'], 'integer'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }

    /**
     * перед удалением почистим связи
     *
     * @return bool
     */
    public function beforeDelete()
    {
        if(parent::beforeDelete()) {

            foreach($this->getOrderProducts()->all() as $model) {
                $model->delete();
            }

            return true;
        }

        return false;
    }
}
