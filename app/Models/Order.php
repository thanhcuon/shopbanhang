<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

// Trong model OrderItem
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customerAddress()
    {
        return $this->belongsTo(CustomerAddress::class, 'customer_address_id');
    }
    // Định nghĩa trường ảo để tính tổng số lượng sản phẩm
    public function getTotalQuantityAttribute()
    {
        $totalQuantity = 0;

        // Lặp qua danh sách orderItems và tính tổng số lượng
        foreach ($this->orderItems as $orderItem) {
            $totalQuantity += $orderItem->quantity;
        }

        return $totalQuantity;
    }

}
