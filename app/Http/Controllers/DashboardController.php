<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): Application|Factory|View
    {
        return view('homepage');
    }
}
