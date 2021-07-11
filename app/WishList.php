<?php

namespace App;

use App\Customer;
use App\User;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wish_lists';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
