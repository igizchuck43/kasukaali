<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserMatch;
use Illuminate\View\View;

class MatchController extends Controller
{
    public function index(): View
    {
        return view('admin.simple-table', ['title' => 'Matches', 'items' => UserMatch::with(['userOne', 'userTwo'])->latest()->paginate(15), 'columns' => ['id', 'status', 'matched_at']]);
    }
}
