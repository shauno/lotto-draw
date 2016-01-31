<?php

namespace Lotto\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function homepage()
    {
        return view('homepage');
    }
}
