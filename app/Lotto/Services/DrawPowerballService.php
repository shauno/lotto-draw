<?php

namespace Lotto\Services;

use Lotto\Interfaces\LottoGameRepositoryInterface;
use Lotto\Interfaces\LottoGameServiceInterface;

class DrawPowerballService extends AbstractDrawLottoService implements LottoGameServiceInterface
{
    /* Implementation of LottoGameRepositoryInterface for persisting games */
    protected $lottoGameRepo;

    public function __construct(LottoGameRepositoryInterface $lottGameRepo)
    {
        $this->lottoGameRepo = $lottGameRepo;
    }

    public function draw()
    {
        $sequence = $this->getRandomSequence();

        if(!$result = $this->lottoGameRepo->save($this, $this->getTotalBallCount(), $this->getGameBallCount(), $sequence)) {
            return false;
        }

        return $result;
    }
}