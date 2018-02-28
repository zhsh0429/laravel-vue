<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $table = 'stock_stockout_orders';
//    public $timestamps = false;
    protected $guarded = [];
}
