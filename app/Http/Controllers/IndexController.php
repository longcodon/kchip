<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Danhmuc;
use App\Models\Thongbao; // Import the Thongbao model
class IndexController extends Controller
{
     public function index()
{
    $danhmuc = Danhmuc::all(); // Lấy tất cả danh mục
    $thongbao = Thongbao::first(); // Lấy thông báo đầu tiên
    return view('layout.index', compact('danhmuc', 'thongbao')); // Truyền biến sang view
}

}
