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
    public $date = null;

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
     * @return string
     */
    public function getData() {
        return $this->data;
    }

    /**
     * вернет данные в виде массива
     *
     * @return array
     */
    public function getArrayData() {
        $xmlstring = $this->getData();

        try {
            $xml = simplexml_load_string($xmlstring);
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);

            return $array;
        }
        catch(Exception $e) {}

        return null;
    }

    /**
     * сохранит данные в модели
     *
     * @param string $modelName
     * @return bool
     */
    public function saveData($data = null, $modelName = '\\app\\models\\Currency') {
        if($data === null) {
            $data = $this->getArrayData();
        }

        $date = $data['@attributes']['Date'];

        if(isset($data['Valute']) && is_array($data['Valute'])) {
            foreach($data['Valute'] as $item) {
                /* @var $model \app\models\Currency */
                $model = new $modelName;
                $model->char_code = $item['CharCode'];
                $model->num_code = $item['NumCode'];
                $model->nominal = (int) $item['Nominal'];
                $model->value = (double) str_replace(',', '.', $item['Value']);
                $model->valute_id = $item['@attributes']['ID'];
                $model->name = $item['Name'];

                if(!$model->createOrUpdate($date)) return false;
            }
        }

        return true;
    }
}