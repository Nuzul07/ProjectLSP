<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    public function food()
    {
        return $this->belongsTo(Food::class, "food_id");
    }
}
