<?php

namespace tests\codeception\unit\currency\components;

use app\modules\currency\components\parser\migration\LoadHistoryCurrency;
use tests\codeception\unit\TestCase;
use Yii;
use Codeception\Specify;

class LoadHistoryCurrencyTest extends TestCase
{
    use Specify;

    public function testLoadHistory() {
        $history = new LoadHistoryCurrency;
        $this->specify('calc history days for parse', function() use($history) {
            expect('count days', $history->getDays())->count(LoadHistoryCurrency::COUNT_DAYS);

            $days = $history->getDays(3);
            expect('load data days by site', $history->loadDataDays($days))->count(3);

            expect('update data by x day', $history->update(2))->true();
        });
    }
}
