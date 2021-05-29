<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'total_paid', 'status'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function productOrders() {
        return $this->hasMany(ProductOrder::class);
    }
}
