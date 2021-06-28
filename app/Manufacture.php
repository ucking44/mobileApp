<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Manufacture extends Model
{
    protected $table = 'manufactures';

    protected $primaryKey = 'manufacture_id';

    protected $fillable = [
        'manufacture_name',
        'manufacture_description',
        'status',
    ];

    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
