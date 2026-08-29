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
}
