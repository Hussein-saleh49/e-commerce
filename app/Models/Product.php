<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        "name",
        "price",
        "stock",
        "image",
        "status",
        "category_id"
    ];

    public function categories(){
        
        return $this->belongsTo(category::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
