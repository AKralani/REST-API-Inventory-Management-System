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
    public function products() {
        return $this->hasMany('App\SoldProduct');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }

    /* protected $casts = [
        'total_amount' => 'integer',
    ]; */
}
