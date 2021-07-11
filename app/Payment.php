<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Payment extends Model
{
    protected $table = 'payments';

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
