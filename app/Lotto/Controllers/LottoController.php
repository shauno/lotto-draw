<?php

namespace Lotto\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lotto\Services\DrawMainService;
use Lotto\Services\DrawPowerballService;

class LottoController extends Controller
{
    public function playMain(DrawMainService $drawService)
    {
        $drawService->setTotalBallCount(env('LOTTO_MAIN_TOTAL'));
        $drawService->setGameBallCount(env('LOTTO_MAIN_GAME'));

        return $drawService->draw();
    }

    public function playPowerball(DrawPowerballService $drawService)
    {
        $drawService->setTotalBallCount(env('LOTTO_POWERBALL_TOTAL'));
        $drawService->setGameBallCount(env('LOTTO_POWERBALL_GAME'));

        return $drawService->draw();
    }

}
