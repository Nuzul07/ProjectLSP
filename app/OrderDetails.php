<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public function orderdetails()
    {
        return $this->belongsTo(Order::class, "order_id");
    }
}
