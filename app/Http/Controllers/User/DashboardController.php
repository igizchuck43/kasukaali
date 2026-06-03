<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\DashboardStatsService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(DashboardStatsService $stats): View
    {
        return view('user.dashboard', ['stats' => $stats->userStats(auth()->user())]);
    }
}
