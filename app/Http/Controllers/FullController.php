<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Danhmuc;

class FullController extends Controller
{
    public function index()
    {
          $danhmuc = Danhmuc::all(); // Lấy tất cả danh mục
        return view('layout.full', compact('danhmuc')); // Truyền biến sang view
       
    }
}
