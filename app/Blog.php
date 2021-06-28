<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'body',
        'image',
        'status',
    ];

}
