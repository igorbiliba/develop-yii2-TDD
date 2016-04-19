<?php

namespace app\modules\currency\components\currency_types;
use app\models\Currency;
use yii\base\Component;

/**
 * базовый класс для валюты
 */
abstract class BaseCurrency extends Component
{
    /**
     * код
     *
     * @var string
     */
    public $code = 'RUB';

    /**
     * текущя сумма в рублях
     *
     * @var null
     */
    public $value = null;

    /**
     * курс валюты
     *
     * @var null
     */
    private $rate = null;

    /**
     * актуальная дата курса
     *
     * @var null
     */
    public $date = null;

    /**
     * вернет курс валюты
     */
    public function getRate() {
        //спросим у модели курс
        $model = Currency::getByCode($this->code);

        return doubleval($model->value);
    }

    /**
     * запишем стоимость в этой валюте
     *
     * @param $value
     */
    public function setPrice($value) {
        $rateVal = $this->getRate();
        $this->value = doubleval($value * $rateVal);
    }

    /**
     * вернет сумму на текущий курс
     */
    public function getPrice($formate = false) {
        $rateVal = $this->getRate();

        if($rateVal == 0) return 0;

        $v = doubleval($this->value / $rateVal);

        if($formate) {
            return number_format($v, 2, ',', ' ');
        }

        return $v;
    }
}