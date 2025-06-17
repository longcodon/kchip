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
        ], 400);
    }

    foreach ($items as $item) {
        $name = $item['name'] ?? 'Không rõ';
        $price = (int) preg_replace('/[^\d]/', '', $item['price'] ?? '0');
        $img = $item['imgSrc'] ?? '';
        $author = $item['author'] ?? 'Không rõ';

        // Kiểm tra nếu sản phẩm đã có thì bỏ qua hoặc cập nhật
        $exists = \DB::table('giohang')->where('name', $name)->first();

        if (!$exists) {
            \DB::table('giohang')->insert([
                'name' => $name,
                'price' => $price,
                'img' => $img,
                'author' => $author
            ]);
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'Đã cập nhật giỏ hàng!'
    ], 200);
}
public function getCart()
{
    $cartItems = \DB::table('giohang')->get();

    return response()->json([
        'success' => true,
        'data' => $cartItems
    ]);
}


}
