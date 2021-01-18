<?php

namespace App;

use App\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //use SoftDeletes;

    protected $table = "products";

    protected $fillable = ['name', 'type_id', 'description', 'price'];
    
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

    public function types() {
        return $this->belongsTo('App\Type');
    }

    public function stocks() {
        return $this->belongsTo('App\Stock');
    }
}

// hasOne
// hasMany
// belongsTo
// belongsToMany
// morphMany
// morphToMany