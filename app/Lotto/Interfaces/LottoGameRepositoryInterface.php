<?php

namespace Lotto\Interfaces;

interface LottoGameRepositoryInterface
{
    public function save(LottoGameServiceInterface $type, $totalBalls, $gameBalls, array $numbers);

    public function getAll();
}