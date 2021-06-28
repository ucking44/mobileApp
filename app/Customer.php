<?php

namespace App;

use App\WishList;
use App\Review;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_name',
        'customer_email',
        'password',
        'mobile_number',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(WishList::class);
    }
}
