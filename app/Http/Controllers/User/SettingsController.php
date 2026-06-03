<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function __invoke(): View
    {
        return view('user.settings');
    }
}
