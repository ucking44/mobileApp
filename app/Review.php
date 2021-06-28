<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\User;
use App\Customer;
//use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Carbon;

class Review extends Model
{
    protected $table = 'reviews';

    protected $primaryKey = 'review_id';

    protected $fillable = [
        'review',
        //'rating',
        //'approved',
        //'spam',
    ];

    public $timestamps = true;

    /**
     * Get the product that owns the review.
     *
     *
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user that made the review.
     *
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // public function scopeApproved($query)
    // {
    //     return $query->where('approved', true);
    // }

    // public function scopeSpam($query)
    // {
    //     return $query->where('spam', true);
    // }

    // public function scopeNotSpam($query)
    // {
    //     return $query->where('spam', false);
    // }

    public function getTimeagoAttribute()
    {
        //return Carbon::parse($value)->format('m/d/Y');
        $date = Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
        return $date;
    }

    public function storeReviewForProduct($product_id, $review, $rating)
    {
        $product = Product::find($product_id);

        // this will be added when we add user's login functionality
        $this->user_id = Auth::user()->id;

        $this->review = $review;
        $this->rating = $rating;
        $product->reviews()->save($this);

        // recalculate ratings for the specified product
        $product->recalculateRating();
    }

    public function getCreateRules()
    {
        return array(
            'review' => 'required|min:10',
            'rating' => 'required|integer|between:1,5'
        );
    }

}

