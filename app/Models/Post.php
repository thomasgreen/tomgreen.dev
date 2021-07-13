<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Orbit\Concerns\Orbital;

class Post extends Model
{
    use Orbital;

    public $timestamps = false;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public static function schema(Blueprint $table): void
    {
        $table->string('title');
        $table->string('slug');
        $table->text('excerpt')->nullable();
        $table->text('content')->nullable();
        $table->timestamp('published_at')->nullable();
        $table->string('category_slug')->nullable();
    }

    public function getPublishedAttribute(): bool
    {
        return $this->published_at && $this->published_at->isPast();
    }

    public function getExcerptAttribute($excerpt): string
    {
        if ($excerpt) {
            return $excerpt;
        }

        return Str::limit($this->content, 100, '');
    }

    public function scopePublished($query)
    {
        if (! app()->environment('production')) {
            return $query->orderBy('published_at', 'DESC');
        }

        return $query
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', now())
            ->orderBy('published_at', 'DESC');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getKeyName(): string
    {
        return 'slug';
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public static function booted(): void
    {
        static::creating(function (Post $post) {
            if (! $post->slug) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function (Post $post) {
            if (! $post->published) {
                $post->slug = Str::slug($post->title);
            }

            Cache::forget('post-content-'.$post->slug);
        });
    }
}
