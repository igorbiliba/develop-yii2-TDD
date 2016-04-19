<?php

namespace tests\codeception\unit\currency\models;

use app\models\Currency;
use Yii;
use tests\codeception\unit\TestCase;
use Codeception\Specify;

class CurrencyTest extends TestCase
{
    use Specify;

    public function testLoadDate() {
        $this->specify('load data', function() {
            expect('work load data by server and base', Currency::getByCode('USD', '01/01/2016'))->notNull();
        });
    }
}
