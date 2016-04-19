<?php

namespace tests\codeception\unit\currency\models;

use app\models\Currency;
use app\modules\currency\components\currency_types\items\CurrencyUSD;
use Yii;
use tests\codeception\unit\TestCase;
use Codeception\Specify;

class UsdTest extends TestCase
{
    use Specify;

    public function testConvert() {
        $currency = new CurrencyUSD();
        $currency->value = 100000;

        $this->specify('convert currency', function() use($currency) {
            expect('work rate', $currency->getRate())->notEmpty();

            $rubPrice = $currency->value;
            $usd = $currency->getPrice();
            $currency->setPrice($usd);

            expect('convert price <==>', $currency->value)->equals($rubPrice);
        });
    }
}
