<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Danhmuc;
use App\Models\Thongbao; // Import the Thongbao model
class FullController extends Controller
{
public function index(Request $request)
{
    $query = Danhmuc::query();

    // Lọc theo người soạn nếu có
    if ($request->filled('transcribed')) {
        $query->where('transcribed', $request->transcribed);
    }

    // Lọc theo thể loại nếu có
    if ($request->filled('country')) {
        $query->where('country', $request->country);
    }

     if ($request->sort === 'asc') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort === 'desc') {
        $query->orderBy('price', 'desc');
    }

    $danhmuc = $query->get();
    $thongbao = Thongbao::first();

    return view('layout.full', compact('danhmuc', 'thongbao'));
}

}
