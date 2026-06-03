<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        return view('admin.simple-table', ['title' => 'Testimonials', 'items' => Testimonial::latest()->paginate(15), 'columns' => ['id', 'name', 'location', 'status']]);
    }
}
