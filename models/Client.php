<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $name
 * @property string $balance
 *
 * @property Order[] $orders
 */
class Client extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'CurrencyWork' => [
                'class' => 'app\modules\currency\components\currency_flow\behaviors\CurrencyWorkBehavior',
                'nameVariable' => 'balance',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'balance'], 'required'],
            [['balance'], 'number'],
            [['name'], 'string', 'max' => 127],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'balance' => 'Balance',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['client_id' => 'id']);
    }
}
