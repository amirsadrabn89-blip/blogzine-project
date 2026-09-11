<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use App\Models\Article;


#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class  User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return \Storage::disk('public')->url($this->avatar);
        }

        return match ($this->gender) {
            'male'   => asset('assets/images/avatar/user_male.png'),
            'female' => asset('assets/images/avatar/user_female.png'),
            default  => asset('assets/images/avatar/user_natural.png'),
        };
    }

    public function getMaskedPhoneAttribute(): ?string
    {
        if (!$this->phone_number) {
            return null;
        }

        return preg_replace(
            '/(\+98-\d{3})-\d{3}-(\d{4})/',
            '$1-***-$2',
            $this->phone_number
        );
    }

    public function getRawPhoneAttribute(): ?string
    {
        if (!$this->phone_number) {
            return null;
        }
        
        // تبدیل +98-935-818-4839 به 09358184839
        return preg_replace('/^\+98-(\d{3})-(\d{3})-(\d{4})$/', '0$1$2$3', $this->phone_number);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'user_id');
    }
    
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')->withTimestamps();
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')->withTimestamps();
    }

    public function favoriteArticles()
    {
        return $this->belongsToMany(Article::class, 'article_favorites')->withTimestamps();
    }

    public function isFollowedByCurrentUser(): bool
    {
        if (! auth()->check() || auth()->id() === $this->id) {
            return false;
        }

        return DB::table('follows')
            ->where('follower_id', auth()->id())
            ->where('following_id', $this->id)
            ->exists();
    }

    public function canBeFollowedBy(?int $currentUserId): bool
    {
        return $currentUserId !== null
            && $currentUserId !== $this->id
            && $this->is_active;
    }

    protected $appends = ['avatar_url'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
            'is_active'         => 'boolean',
            'smsConsent'        => 'boolean',
            'newsConsent'       => 'boolean',
        ];
    }
    
    protected $fillable = [
        'name',
        'username',
        'email',
        'email_verified_at',
        'password',
        'password_profile',
        'gender',
        'phone_number',
        'avatar',
        'job_title',
        'province',
        'bio',
        'facebook',
        'linkedin',
        'twitter',
        'is_active',
        'is_admin',
        'showProfile',
        'smsConsent',
        'newsConsent',
    ];
}
