<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentBlock extends Model
{
    protected $fillable = [
        'date', 'full_day', 'start_time', 'end_time', 'reason',
    ];

    protected $casts = [
        'date'     => 'date',
        'full_day' => 'boolean',
    ];
}
