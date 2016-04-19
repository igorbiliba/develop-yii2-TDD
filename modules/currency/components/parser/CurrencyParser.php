<?php

namespace app\modules\currency\components\parser;

use yii\base\Component;
use yii\base\Exception;

/**
 * класс парсинга xml валют
 *
 * Class CurrencyParser
 * @package app\modules\currency\components\parser
 */
class CurrencyParser extends Component
{
    const URL = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=';

    /**
     * дата парсинга
     */
    private $date = null;

    /**
     * данные парсинга
     */
    private $data = null;

    /**
     * урл парсинга с датой
     *
     * @var null
     */
    private $url = null;

    /**
     * вернет url
     *
     * @return null
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * установить дату парсинга
     *
     * @param $value
     */
    public function setDate($value) {
        $this->date = str_replace(['.', ','], ['/', '/'], $value);
    }

    /**
     * инициализирует url
     */
    public function initUrl() {
        $this->url = self::URL . $this->date;
    }

    /**
     * выполнить парсинг
     *
     * @return bool
     */
    public function parse() {
        $this->initUrl();
        $this->data = $this->loadDateBySite();

        return ($this->data !== null);
    }

    /**
     * загрузим xml с сайта
     *
     * @return null|string
     */
    public function loadDateBySite() {
        try {
            return file_get_contents($this->url);
        }
        catch(Exception $e) {}

        return null;
    }

    /**
     * венет данные
     *
     * @return array
     */
    public function getData() {
        return $this->data;
    }
}