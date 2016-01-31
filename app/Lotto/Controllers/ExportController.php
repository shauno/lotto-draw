<?php

namespace Lotto\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lotto\Services\ExportGamesService;

class ExportController extends Controller
{
    public function csv(ExportGamesService $exportService)
    {
        $data = $exportService->csv();

        return response($data, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="export.csv"',
        ]);
    }

}
