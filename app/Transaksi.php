<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function food()
    {
        return $this->belongsTo(Food::class, "food_id");
    }
    public function order()
    {
        return $this->belongsTo(Order::class, "order_id");
    }
}
