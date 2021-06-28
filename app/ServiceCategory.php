<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'service_categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'category_name',
        'category_description',
        'status',
    ];
}

