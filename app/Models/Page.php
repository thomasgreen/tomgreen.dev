<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Orbit\Concerns\Orbital;

class Page extends Model
{
    use Orbital;

    public $timestamps = false;

    public static function schema(Blueprint $table): void
    {
        $table->string('title');
        $table->string('slug');
        $table->text('content')->nullable();
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
        static::creating(function (Page $page) {
            $page->slug = Str::slug($page->title);
        });

        static::updating(function (Page $page) {
            $page->slug = Str::slug($page->title);

            Cache::forget('page-content-'.$page->slug);
        });
    }
}
