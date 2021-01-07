<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';

    //protected $fillable = ['stock_name', 'stock_quantity', 'category_name', 'purchase_cost', 'selling_cost', 'suppler_cost'];
    protected $fillable = ['description', 'quantity'];
}
