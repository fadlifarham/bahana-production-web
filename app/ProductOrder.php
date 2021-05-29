<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'amount', 'price'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
