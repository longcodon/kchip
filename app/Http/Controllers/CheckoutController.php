<?php

// app/Http/Controllers/CheckoutController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'customerName' => 'required|string|max:255',
            'customerEmail' => 'required|email',
            'paymentMethod' => 'required|in:momo,bank,cod',
            'items' => 'required|array',
            'total' => 'required|numeric'
        ]);
        
        try {
            // Tạo đơn hàng
            $order = Order::create([
                'customer_name' => $validated['customerName'],
                'customer_email' => $validated['customerEmail'],
                'customer_fb' => $request->input('customerFB'),
                'note' => $request->input('customerNote'),
                'payment_method' => $validated['paymentMethod'],
                'total_amount' => $validated['total'],
                'status' => 'pending'
            ]);
            
            // Thêm items vào đơn hàng
            foreach ($validated['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }
            
            return response()->json([
                'success' => true,
                'orderId' => $order->id,
                'message' => 'Đơn hàng đã được tạo thành công'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
