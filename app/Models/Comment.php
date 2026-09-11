<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Comment extends Model
{
    protected $fillable = [
        'article_id',
        'user_id',
        'parent_id',
        'title',
        'body',
        'is_show',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'is_show' => 'boolean',
            'read_at' => 'datetime',
        ];
    }

    protected $appends = ['user_avatar_url'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function approvedReplies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->where('is_show', true)
            ->latest();
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function getUserAvatarUrlAttribute(): string
    {
        return $this->user?->avatar_url ?? asset('assets/images/avatar/user_natural.png');
    }
}