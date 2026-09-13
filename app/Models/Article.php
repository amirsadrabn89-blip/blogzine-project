<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'tags',
        'body',
        'main_image',
        'is_show',
        'views',
        'read_time',
        'published_at',
    ];

    protected $casts = [
        'is_show'        => 'boolean',
        'published_at'   => 'datetime',
        'views'          => 'integer',
        'read_time'      => 'integer',
        'tags'           => 'array',
    ];

    public function getMainImageAttribute($value): string
    {
        if (!$value) {
            return '/assets/images/no-image-available.jpg';
        }

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        return '/storage/' . ltrim($value, '/');
    }

    protected function body(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if (! $value) {
                    return $value;
                }

                // اضافه کردن https:// به لینک‌های بدون پروتکل
                $value = preg_replace(
                    '/<a\s+([^>]*?)href=["\'](?!https?:\/\/|\/|#|mailto:|tel:)([^"\']+)["\']/i',
                    '<a $1href="https://$2"',
                    $value
                );

                // باز شدن لینک‌های خارجی در تب جدید (اختیاری ولی توصیه شده)
                return preg_replace(
                    '/<a\s+([^>]*?)href=["\'](https?:\/\/[^"\']+)["\'](?!.*target=)/i',
                    '<a $1href="$2" target="_blank" rel="noopener noreferrer"',
                    $value
                );
            }
        );
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'article_id');
    }

    public function rootComments(): HasMany
    {
        return $this->hasMany(Comment::class, 'article_id')
            ->whereNull('parent_id')
            ->where('is_show', true)
            ->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(ArticleReaction::class);
    }

    public function viewsDetails(): HasMany
    {
        return $this->hasMany(ArticleView::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'article_favorites')->withTimestamps();
    }

    public function isFavoritedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }

}
