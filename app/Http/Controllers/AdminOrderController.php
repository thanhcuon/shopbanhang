<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{


    public function index()
    {
        $orders = Order::with(['orderItems.product', 'customerAddress'])->get(); // Lấy danh sách đơn hàng với thông tin sản phẩm và địa chỉ khách hàng
        return view('admin.orders.index', compact('orders'));
    }

    public function approve(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order) {
            // Thay đổi trạng thái đơn hàng thành đã duyệt
            $order->status = 'đã duyệt';
            $order->save();

            // Trả về phản hồi JSON thành công
            return response()->json(['success' => true]);
        }

        // Trả về phản hồi JSON thất bại
        return response()->json(['success' => false]);
    }

}
