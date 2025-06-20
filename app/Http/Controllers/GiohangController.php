<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class GiohangController extends Controller
{
  public function saveCart(Request $request)
{
    if (!Auth::check()) {
        return response()->json([
            'success' => false,
            'message' => 'Bạn cần đăng nhập để thêm vào giỏ hàng.'
        ], 403);
    }

    $items = $request->input('items');

    if (!is_array($items)) {
        return response()->json([
            'success' => false,
            'message' => 'Dữ liệu không hợp lệ'
        ]);
    }

    foreach ($items as $item) {
        $name = $item['name'] ?? '';
        $price = (int) preg_replace('/[^\d]/', '', $item['price'] ?? '0');
        $img = $item['imgSrc'] ?? '';
        $author = $item['author'] ?? 'Không rõ';

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
        'message' => 'Đã thêm vào giỏ hàng!'
    ]);
}
public function getCart()
{
    $cartItems = \DB::table('giohang')->get(); // Không cần lọc theo user

    return response()->json([
        'success' => true,
        'data' => $cartItems
    ]);
}

public function remove(Request $request)
{
    $name = $request->input('name');

    if (!$name) {
        return response()->json(['success' => false, 'message' => 'Thiếu tên sản phẩm'], 400);
    }

    $exists = DB::table('giohang')->where('name', $name)->exists();

    if (!$exists) {
        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm'], 404);
    }

    DB::table('giohang')->where('name', $name)->delete();

    return response()->json(['success' => true, 'message' => 'Đã xoá sản phẩm']);
}

}
