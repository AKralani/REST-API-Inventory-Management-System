<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivedProduct extends Model
{
    protected $fillable = [
        'product_id', 'total_amount'
    ];

    public function receipt()
    {
        return $this->belongsTo('App\Receipt');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
