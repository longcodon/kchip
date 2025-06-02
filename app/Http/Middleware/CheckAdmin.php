<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
//    public function handle(Request $request, Closure $next): Response
//     {
//         if (auth()->check()) {
//             // Nếu check=1 thì cho vào dashboard
//             if (auth()->user()->check == 1) {
//                 return $next($request);
//             }
//             // Ngược lại chuyển hướng về trang welcome
//             return redirect('/');
//         }

//         return redirect('/login');
//     }

public function handle(Request $request, Closure $next): Response
{
    if (auth()->check()) {
        if (auth()->user()->check == 1) {
            return $next($request);
        }
        return redirect()->route('index');
    }

    return redirect('/login');
}
}
