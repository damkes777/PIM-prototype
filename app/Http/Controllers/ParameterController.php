<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ParameterController extends Controller
{
    public function list(): View
    {
        return view('parameter.list');
    }

    public function create(): View
    {
        return view('parameter.create');
    }
}