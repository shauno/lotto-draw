<?php

namespace Lotto\Interfaces;

interface LottoGameServiceInterface
{
    public function setTotalBallCount($count);

    public function getTotalBallCount();

    public function setGameBallCount($count);

    public function getGameBallCount();

    public function draw();
}