<?php

namespace Meletisf\Zen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Zen;

class HealthController extends Controller
{
    public function index(Request $request)
    {
        Zen::runDiagnostics();
        return Zen::respond();
    }
}
