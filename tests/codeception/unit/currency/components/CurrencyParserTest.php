<?php

namespace tests\codeception\unit\currency\components;

use app\modules\currency\components\parser\CurrencyParser;
use Yii;
use tests\codeception\unit\TestCase;
use Codeception\Specify;

class CurrencyParserTest extends TestCase
{
    use Specify;

    public function testParse() {
        $parser = new CurrencyParser();
        $parser->date = '01/01/2016';
        $parser->initUrl();

        $this->specify('test parse work', function() use($parser) {
            expect('valid url', $parser->url)->contains($parser->date);
            $data = $parser->loadDateBySite();
            expect('load data by date', $data)->contains(str_replace('/', '.', $parser->date));
            expect('has items currency', $data)->contains('Valute');
            expect('parse worked', $parser->parse())->true();
            expect('parser data valid', $parser->data)->equals($data);
        });

        $this->specify('test save data', function() use($parser) {
            expect('parse worked', $parser->parse())->true();
            $arr = $parser->getArrayData();
            expect('work array data formater', $arr)->hasKey('Valute');
            $arr['Valute'] = [$arr['Valute'][0]];
            expect('work save data in base', $parser->saveData($arr))->true();
        });
    }
}
