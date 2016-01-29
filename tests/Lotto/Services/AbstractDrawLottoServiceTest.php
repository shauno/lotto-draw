<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class AbstractDrawLottoServiceTest
 * This test the abstract methods in AbstractDrawLottoService, using the "DrawLottoService" implementation
 */
class AbstractDrawLottoServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected $drawService;

    public function setUp()
    {
        parent::setUp();

        $repo = $this->app->make('\Lotto\Repositories\LottoGameRepository');
        $this->drawService = new \Lotto\Services\DrawMainService($repo);
    }

    public function test_setTotalBallCount_sets_totalBallCount_property()
    {
        $this->drawService->setTotalBallCount(50);

        $this->assertEquals(50, $this->drawService->getTotalBallCount());
    }

    public function test_setGameBallCount_sets_gameBallCount_property()
    {
        $this->drawService->setTotalBallCount(50);
        $this->drawService->setGameBallCount(5);

        $this->assertEquals(5, $this->drawService->getGameBallCount());
    }

    public function test_setGameBallCount_cannot_be_smaller_than_onet()
    {
        $this->setExpectedException('\Lotto\Exceptions\InvalidCountException', 'gameBallCount cannot be less than 1');

        $this->drawService->setGameBallCount(-1);
    }

    public function test_setGameBallCount_cannot_be_larger_than_totalBallCount()
    {
        $this->setExpectedException('\Lotto\Exceptions\InvalidCountException', 'gameBallCount must be less than totalBallCount');

        $this->drawService->setTotalBallCount(50);
        $this->drawService->setGameBallCount(51);
    }
}