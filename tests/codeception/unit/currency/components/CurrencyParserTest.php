<?php

namespace tests\codeception\unit\currency\components;

use app\modules\currency\components\parser\CurrencyParser;
use Yii;
use yii\codeception\TestCase;
use Codeception\Specify;

class CurrencyParserTest extends TestCase
{
    public function testParseData() {
        $date = '01/01/2016';

        $parser = new CurrencyParser();
        $parser->date = $date;
        $parser->initUrl();

        expect('valid url', $parser->url)->contains($date);
        $data = $parser->loadDateBySite();
        expect('load data by date', $data)->contains(str_replace('/', '.', $date));
        expect('has items currency', $data)->contains('Valute');
        expect('parse worked', $parser->parse())->true();
        expect('parser data valid', $parser->data)->equals($data);
    }
}
