<?php

namespace app\modules\currency\components\currency_types\items;
use app\modules\currency\components\currency_types\BaseCurrency;

/**
 * класс для RUB валюты
 */
class CurrencyRUB extends BaseCurrency
{
    /**
     * вернет курс валюты
     */
    public function getRate() {
        return 1;
    }

    /**
     * запишем стоимость в этой валюте
     *
     * @param $value
     */
    public function setPrice($value) {
        $this->value = doubleval($value);
    }

    /**
     * вернет сумму на текущий курс
     */
    public function getPrice() {
        return doubleval($this->value);
    }
}