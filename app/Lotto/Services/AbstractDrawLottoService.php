<?php

namespace Lotto\Services;

use Lotto\Exceptions\InvalidCountException;

class AbstractDrawLottoService
{
    /* The number of balls in a set */
    protected $totalBallCount = 0;

    /* The number of balls selected from a set to constitute a complete game */
    protected $gameBallCount = 0;

    public function setTotalBallCount($count)
    {
        if($count < 1) {
            throw new InvalidCountException('gameBallCount must be less than totalBallCount');
        }

        $this->totalBallCount = $count;
    }

    public function getTotalBallCount()
    {
        return $this->totalBallCount;
    }

    public function setGameBallCount($count)
    {
        if($count < 1) {
            throw new InvalidCountException('gameBallCount cannot be less than 1');
        }

        if($count >= $this->totalBallCount) {
            throw new InvalidCountException('gameBallCount must be less than totalBallCount');
        }

        $this->gameBallCount = $count;
    }

    public function getGameBallCount()
    {
        return $this->gameBallCount;
    }

    protected function getRandomSequence()
    {
        $draw = [];

        if(!$this->getTotalBallCount()) {
            throw new InvalidCountException('Please set totalBallCount before calling draw()');
        }

        if(!$this->getGameBallCount()) {
            throw new InvalidCountException('Please set gameBallCount before calling draw()');
        }

        while(count($draw) < $this->getGameBallCount())
        {
            $number = random_int(1, $this->getTotalBallCount()); //random_int() is supposedly crypto safe, yay \o/ (using compat library provided by the framework)

            if(!in_array($number, $draw)) {
                $draw[] = $number;
            }
        }

        sort($draw, SORT_NUMERIC);

        return $draw;
    }
}