<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_number', 'user_id', 'service_id', 'name', 'email', 'phone',
        'appointment_date', 'appointment_time', 'status', 'notes', 'admin_notes',
        'order_id',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public static function generateAppointmentNumber(): string
    {
        return 'APT-' . strtoupper(substr(uniqid(), -6)) . '-' . date('Ymd');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending'     => '<span class="badge bg-warning">Pending</span>',
            'confirmed'   => '<span class="badge bg-info">Confirmed</span>',
            'rejected'    => '<span class="badge bg-danger">Rejected</span>',
            'rescheduled' => '<span class="badge bg-secondary">Rescheduled</span>',
            'cancelled'   => '<span class="badge bg-dark">Cancelled</span>',
            'completed'   => '<span class="badge bg-success">Completed</span>',
            default       => '<span class="badge bg-secondary">' . ucfirst($this->status) . '</span>',
        };
    }

    public function scopeUpcoming($q)
    {
        return $q->whereDate('appointment_date', '>=', now()->toDateString())
            ->whereNotIn('status', ['cancelled', 'rejected', 'completed']);
    }
}
