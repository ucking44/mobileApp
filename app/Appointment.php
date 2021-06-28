<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $primaryKey = 'id';

    protected $fillable = [
        'service_id',
        'firstName',
        'lastName',
        'date',
        'time',
        'gender',
        'email',
        'phone',
        'message',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}

