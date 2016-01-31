<?php

namespace Lotto\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lotto\Services\DrawMainService;

class LottoController extends Controller
{
    public function playMain(DrawMainService $drawService)
    {
        $drawService->setTotalBallCount(env('LOTTO_MAIN_TOTAL'));
        $drawService->setGameBallCount(env('LOTTO_MAIN_GAME'));

        return $drawService->draw();
    }
}
