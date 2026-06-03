<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        return view('admin.simple-table', ['title' => 'Messages', 'items' => Message::with(['sender', 'receiver'])->latest()->paginate(15), 'columns' => ['id', 'message', 'created_at']]);
    }
}
