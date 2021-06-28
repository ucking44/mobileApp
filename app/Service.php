<?php

namespace App;
//use App\ServiceCategory;
use App\Appointment;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $primaryKey = 'id';

    protected $fillable = [
        'service_name',
        'fee',
        'duration',
        'status',
    ];

    // public function serviceCategory()
    // {
    //     return $this->belongsTo(ServiceCategory::class);
    // }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}

