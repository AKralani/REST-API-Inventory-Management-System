<?php

namespace App;

use App\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //use SoftDeletes;

    protected $table = "products";

    protected $fillable = ['name', 'type', 'description', 'product_category_id', 'price', 'stock', 'stock_defective'];
    
    protected $with = ['category'];

    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function solds()
    {
        return $this->hasMany('App\SoldProduct');
    }

    public function receiveds()
    {
        return $this->hasMany('App\ReceivedProduct');
    }
}
