<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardStatsService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(DashboardStatsService $stats): View
    {
        return view('admin.dashboard', ['stats' => $stats->adminStats()]);
    }
}
