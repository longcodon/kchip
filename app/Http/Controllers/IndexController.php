<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Danhmuc;
class IndexController extends Controller
{
     public function index()
{
    $danhmuc = Danhmuc::all(); // Lấy tất cả danh mục
    return view('layout.index', compact('danhmuc')); // Truyền biến sang view
}

}
