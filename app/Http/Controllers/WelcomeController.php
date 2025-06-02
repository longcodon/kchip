<?php

namespace App\Http\Controllers;
use App\Models\Danhmuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
{
    $danhmuc = Danhmuc::all(); // Lấy tất cả danh mục
    return view('welcome', compact('danhmuc')); // Truyền biến sang view
}

    public function check()
    {
        if(!Auth::user())
        {
            return redirect()->route('login');
        }
        if(Auth::user()->check ==1)
        {
            return redirect()->route('dashboard'); 
        }
        if(Auth::user()->check == 0)
        {
            return redirect()->route('welcome'); 
        }
    }

}
