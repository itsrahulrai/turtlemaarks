<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentSetting extends Model
{
    protected $fillable = [
        'day_of_week', 'is_working_day', 'start_time', 'end_time', 'slot_duration_minutes',
        'break_start', 'break_end', 'gap_minutes',
    ];

    protected $casts = [
        'is_working_day' => 'boolean',
    ];

    public const DAYS = [
        0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday',
        4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday',
    ];

    public function getDayNameAttribute(): string
    {
        return self::DAYS[$this->day_of_week] ?? '';
    }
}
