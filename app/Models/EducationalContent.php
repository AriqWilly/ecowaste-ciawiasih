<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'category_id', 'title', 'slug', 'content', 'media_path', 'published_at'
])]
class EducationalContent extends Model
{
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getMediaUrlAttribute(): string
    {
        if (!$this->media_path) {
            return 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80';
        }

        if (\Illuminate\Support\Str::startsWith($this->media_path, ['http://', 'https://'])) {
            return $this->media_path;
        }

        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($this->media_path)) {
            return 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80';
        }

        return \Illuminate\Support\Facades\Storage::url($this->media_path);
    }
}
