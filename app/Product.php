<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //use SoftDeletes;

    protected $table = "products";

    protected $fillable = ['name', 'type', 'description', 'product_category_id', 'price', 'stock', 'stock_defective'];

    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'product_category_id')->withTrashed();
    }

    /* public function solds()
    {
        return $this->hasMany('App\SoldProduct');
    }

    public function receiveds()
    {
        return $this->hasMany('App\ReceivedProduct');
    } */
}
