<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExportGamesServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected $exportService;

    protected $drawService;

    public function setUp()
    {
        parent::setUp();

        $repo = $this->app->make('\Lotto\Repositories\LottoGameRepository');
        $this->exportService = new \Lotto\Services\ExportGamesService($repo);

        $this->drawService = new \Lotto\Services\DrawMainService($repo);

    }

    public function test_csv_method_returns_csv_data()
    {
        $this->drawService->setTotalBallCount(50);
        $this->drawService->setGameBallCount(5);

        $results = $this->drawService->draw();

        $numbers = $results->numbers->map(function($tmp) {
            return $tmp->number;
        });

        $csv = $this->exportService->csv();

        $csvShouldBe = 'id,Type,"Total Balls","Game Balls","Created At",Numbers'.PHP_EOL;
        $csvShouldBe .= '1,DrawMainService,50,5,"'.$results->created_at.'","'.$numbers->implode(',').'"'.PHP_EOL;

        $this->assertEquals($csvShouldBe, $csv);

    }

}
