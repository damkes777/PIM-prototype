<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ParameterController extends Controller
{
    public function list(): View
    {
        return view('parameter.list');
    }

    public function edit(int $id): View
    {
        return view('parameter.edit', ['parameterId' => $id]);
    }

    public function create(): View
    {
        return view('parameter.create');
    }
}