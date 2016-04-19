<?php

namespace app\modules\currency\components\parser\migration;

use app\modules\currency\components\parser\CurrencyParser;
use yii\base\Component;
use yii\base\Exception;

/**
 * класс парсинга xml валют
 *
 * заполнит историю валют за последние x дней
 *
 * Class CurrencyParser
 * @package app\modules\currency\components\parser\migration
 */
class LoadHistoryCurrency extends Component
{
    /**
     * x дней для истории валют
     */
    const COUNT_DAYS = 45;

    /**
     * день
     */
    const STEP = 86400;//60*60*24

    /**
     * расчитает дни, которые нужно парсить
     *
     * @return array
     */
    public function getDays($count = null) {
        if($count === null) {
            $count = self::COUNT_DAYS;
        }

        $items = [];
        $now = time();

        for($i = 0; $i < $count; $i++) {
            $date = date('d/m/Y', $now - (self::STEP * $i));
            $items[] = $date;
        }

        return $items;
    }

    /**
     * загрузим данные по дням
     *
     * @param $days
     * @return array
     */
    public function loadDataDays($days = null) {
        if($days == null) $days = $this->getDays();

        $items = [];

        foreach($days as $day) {
            $parser = new CurrencyParser;
            $parser->date = $day;
            $parser->initUrl();

            if($parser->parse()) {
                $items[] = $parser;
            }
        }

        return $items;
    }

    /**
     * загрузим изменения за x дней
     */
    public function update($countDays = null) {
        if($countDays === null) $countDays = self::COUNT_DAYS;

        $days = $this->getDays($countDays);
        $daysData = $this->loadDataDays($days);

        /* @var $parser CurrencyParser */
        foreach($daysData as $parser) {
            if(!$parser->saveData()) return false;
        }

        return true;
    }
}