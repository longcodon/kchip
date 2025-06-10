<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GiohangController extends Controller
{
    public function saveCart(Request $request)
{
    $items = $request->input('items');

    if (!is_array($items)) {
        return response()->json([
            'success' => false,
            'message' => 'Dữ liệu không hợp lệ'
        ], 400, ['Content-Type' => 'application/json']);
    }
 
    // ✅ XÓA TOÀN BỘ DỮ LIỆU CŨ TRONG GIOHANG
    \DB::table('giohang')->truncate();

    foreach ($items as $item) {
       \DB::table('giohang')->insert([
    'name' => $item['name'] ?? 'Không rõ',
    'price' => (int) preg_replace('/[^\d]/', '', $item['price'] ?? '0'),
    'img' => $item['imgSrc'] ?? '',
    'author' => $item['author'] ?? 'Không rõ' // ✅ Thêm dòng này
]);

    }

    return response()->json([
        'success' => true,
        'message' => 'Đã cập nhật giỏ hàng!'
    ], 200, ['Content-Type' => 'application/json']);
}

}
