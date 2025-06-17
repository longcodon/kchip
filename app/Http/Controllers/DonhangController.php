<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khachhang;
class DonhangController extends Controller
{
public function index()
{
    // Lấy đơn hàng mới nhất của người dùng (tuỳ logic bạn)
    $donhang = Khachhang::latest()->first();

    return view('layout.donhang', compact('donhang'));
}
}
