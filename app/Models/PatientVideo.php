<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientVideo extends Model
{
    protected $fillable = [
        'youtube_id', 'thumbnail', 'topic_label', 'title', 'card_description',
        'badge', 'duration', 'location', 'modal_title', 'modal_badge',
        'speaker', 'modal_description', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return asset('/storage/' . $this->thumbnail);
        }

        return "https://img.youtube.com/vi/{$this->youtube_id}/hqdefault.jpg";
    }

    public function getModalTitleTextAttribute(): string
    {
        return $this->modal_title ?: $this->title;
    }

    public function getModalBadgeTextAttribute(): string
    {
        return $this->modal_badge ?: $this->badge;
    }

    public function getModalDescriptionTextAttribute(): string
    {
        return $this->modal_description ?: $this->card_description;
    }
}
