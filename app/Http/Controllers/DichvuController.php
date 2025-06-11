<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DichvuController extends Controller
{
    public function index()
    {
        return view('layout.dichvu');
    }
}
