<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khachhang;
use Illuminate\Support\Facades\Auth; // Thêm dòng này để sử dụng Auth

class DonhangController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đang đăng nhập

        // Đảm bảo người dùng đã đăng nhập
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem đơn hàng.');
        }

        // Lọc đơn hàng theo email người dùng
        $donhang = Khachhang::where('email', $user->email)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('layout.donhang', compact('donhang'));
    }
}
