<?php

namespace tests\codeception\unit\currency\models;

use app\models\Currency;
use app\models\Product;
use app\modules\currency\components\currency_types\items\CurrencyUSD;
use Yii;
use tests\codeception\unit\TestCase;
use Codeception\Specify;

class BehaviorTest extends TestCase
{
    use Specify;

    public function testBehavior() {
        $product = new Product();
        $product->name = 'test product';
        $product->price = 0;
        $product->save();

        $this->specify('load data', function() use($product) {
            $usd = new CurrencyUSD();
            $usd->setPrice(1000);
            expect('set formated price', $product->setFormatedPrice($usd))->true();

            $objPrice = $product->getFormatedPrice('USD');
            expect('equals converted price behavior', $objPrice->getPrice())->equals($usd->getPrice());
        });
    }

    public function tearDown()
    {
        Product::deleteAll([
            'name' => 'test product',
        ]);

        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}
