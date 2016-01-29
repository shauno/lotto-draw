<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class DrawPowerballServiceTest extends TestCase
{
    //use DatabaseTransactions;

    protected $drawService;

    public function setUp()
    {
        parent::setUp();

        $repo = $this->app->make('\Lotto\Repositories\LottoGameRepository');
        $this->drawService = new \Lotto\Services\DrawPowerballService($repo);
    }

    public function test_draw_throws_exception_if_totalBallCount_not_set()
    {
        $this->setExpectedException('\Lotto\Exceptions\InvalidCountException', 'Please set totalBallCount before calling draw()');

        $this->drawService->draw();
    }

    public function test_draw_throws_exception_if_gameBallCount_count_not_set()
    {
        $this->drawService->setTotalBallCount(50);

        $this->setExpectedException('\Lotto\Exceptions\InvalidCountException', 'Please set gameBallCount before calling draw()');

        $this->drawService->draw();
    }

    public function test_draw_returns_gameBallCount_keys()
    {
        $this->drawService->setTotalBallCount(50);
        $this->drawService->setGameBallCount(5);

        $draw = $this->drawService->draw();

        $this->assertCount(5, $draw->numbers);
    }

    public function test_draw_saves_result_in_database_and_row_is_returned()
    {
        $this->drawService->setTotalBallCount(50);
        $this->drawService->setGameBallCount(5);

        $draw = $this->drawService->draw();

        $this->seeInDatabase('lotto_games', [
            'id' => $draw->id,
            'type' => 'DrawPowerballService',
            'total_balls' => 50,
            'game_balls' => 5,
        ]);

        foreach($draw->numbers as $number) {
            $this->seeInDatabase('lotto_game_numbers', [
                'lotto_games_id' => $draw->id,
                'number' => $number->number,
            ]);
        }
    }

}
