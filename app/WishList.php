<?php

namespace App;

use App\Customer;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wish_lists';

    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'product_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
