<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_name',
        'category_description',
        'status',
    ];

    public $timestamps = true;

    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }

    public function product()
    {
        return $this->hasOne(Product::class);
    }

}
