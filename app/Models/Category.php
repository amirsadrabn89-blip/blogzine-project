<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_show',
    ];

    protected $casts = [
        'is_show' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('active', function ($builder) {
            if (!app()->runningInConsole()) {
                if (!auth()->check() || !auth()->user()->is_admin) {
                    $builder->where('is_show', true);
                }
            }
        });
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}