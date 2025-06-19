<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khachhang;
class DonhangController extends Controller
{
public function index()
{
    $donhang = Khachhang::orderBy('created_at', 'desc')->get();
    return view('layout.donhang', compact('donhang'));
}
}

