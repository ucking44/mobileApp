<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Review;
use App\Category;
use App\Manufacture;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'category_id',
        'manufacture_id',
        'product_name',
        'product_description',
        'product_price',
        'stock',
        'product_image',
        'product_size',
        'product_color',
        'status',
    ];

    public $timestamps = true;

    /**
     * Get the reviews of the product
     *
     *
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class);
    }

    public function recalculateRating()
    {
        //$reviews = $this->reviews()->notSpam()->approved();
        $avgRating = $reviews->avg('rating');
        $this->rating_cache = round($avgRating,1);
        $this->rating_count = $reviews->count();
        $this->save();
    }

    /**
     * Get the user that added the product.
     *
     *
     */
    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    //     // return $this->belongsTo(User::class, 'user_id');
    // }

}


