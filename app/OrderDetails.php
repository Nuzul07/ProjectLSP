<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class, "order_id");
    }
    public function food()
    {
        return $this->belongsTo(Food::class, "food_id");
    }
}
