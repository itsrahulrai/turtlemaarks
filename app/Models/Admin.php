<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'avatar', 'is_active', 'role', 'role_id',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function assignedRole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function isSuperAdmin(): bool
    {
        return in_array($this->role, ['superadmin', 'super_admin'], true);
    }

    /**
     * Roles & Permissions check.
     * Super admins always pass. Everyone else needs the permission slug
     * attached (directly or via their assigned Role) to their account.
     */
    public function hasPermission(string $slug): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return (bool) ($this->role_id && $this->assignedRole?->permissions->contains('slug', $slug));
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar
            ? asset('/storage/' . $this->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=0C3C64&color=fff';
    }
}
