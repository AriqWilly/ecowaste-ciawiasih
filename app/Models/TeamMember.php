<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'role',
        'type',
        'photo_path',
        'description',
        'order',
        'is_active'
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }

    /**
     * Scope active members.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pengurus.
     */
    public function scopePengurus($query)
    {
        return $query->where('type', 'pengurus');
    }

    /**
     * Scope mitra.
     */
    public function scopeMitra($query)
    {
        return $query->where('type', 'mitra');
    }

    public function getPhotoUrlAttribute(): string
    {
        if (!$this->photo_path) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=0d631b&color=ffffff';
        }

        if (\Illuminate\Support\Str::startsWith($this->photo_path, ['http://', 'https://'])) {
            return $this->photo_path;
        }

        return \Illuminate\Support\Facades\Storage::url($this->photo_path);
    }
}
