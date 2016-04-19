<?php

namespace app\modules\currency\components\currency_flow\behaviors;

use app\modules\currency\components\currency_types\BaseCurrency;
use yii\base\Behavior;

/**
 * бихейвор, который умеет форматировать стоимость в человекопонятный вид,
 * принимать отформатированный ввод и сохранять в бд,
 * конвертировать из любой валюты в любую
 *
 * Class CurrencyWorkBehavior
 * @package app\modules\currency\components\currency_flow\behaviors
 */
class CurrencyWorkBehavior extends Behavior
{
    /**
     * имя переменной в модели
     *
     * @var null
     */
    public $nameVariable = null;

    /**
     * позволяет записать форматированную стоимость
     * и сохрать в базу
     *
     * @param $obj
     */
    public function setFormatedPrice(BaseCurrency $obj) {
        $this->owner->{$this->nameVariable} = $obj->value;
        return $this->owner->save();
    }

    /**
     * возвращает класс форматированной стоимости
     *
     * @param string $charCode
     */
    public function getFormatedPrice($charCode = 'USD') {
        $className ='app\\modules\\currency\\components\\currency_types\\items\\Currency' . $charCode;

        if(class_exists($className)) {
            /* @var $obj \app\modules\currency\components\currency_types\BaseCurrency */
            $obj = new $className;
            $obj->value = ($this->owner->{$this->nameVariable});

            return $obj;
        }

        return null;
    }
}