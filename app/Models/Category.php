<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Orbit\Concerns\Orbital;

class Category extends Model
{
    use Orbital;

    public $timestamps = false;

    public static function schema(Blueprint $table): void
    {
        $table->string('title');
        $table->string('slug');
        $table->string('color')->nullable();
    }

    public function url(): string
    {
        return route('posts.index', [
            'category' => $this->slug,
        ]);
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
        static::creating(function (Category $category) {
            if (! $category->slug) {
                $category->slug = Str::slug($category->title);
            }
        });

        static::updating(function (Category $category) {
            if (! $category->published) {
                $category->slug = Str::slug($category->title);
            }
        });
    }
}
