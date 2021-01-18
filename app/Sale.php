<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    //protected $fillable = ['description', 'client_id', 'user_id'];
    protected $fillable = ['description', 'product_id', 'total_amount', 'price', 'total_price'];

    public function transactions() {
        return $this->hasMany('App\Transaction');
    }
    /* public function products() {
        return $this->hasMany('App\SoldProduct');
    } */
    public function products() {
        return $this->hasMany('App\Product'); // select * from products where product_id = 1
    }
    public function user() {
        return $this->belongsTo('App\User');
    }

    /* protected $casts = [
        'total_amount' => 'integer',
    ]; */
}

// $sale = Sale::find(1); // select * from sale where id = 1
// $sale->products; // select * from products where product_id = $sale->id
// $sale->products->last()
//                ->first()
//                ->find()
//                ->split(3)
//                ->groupBy