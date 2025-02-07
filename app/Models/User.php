<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Subscription;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'profile_picture',
        'date_of_birth',
        'gender',
        'preferred_language',
        'role',
        'is_banned',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function ratings()
    {
        return $this->hasMany(ArticleRating::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function categoryRatings()
    {
        return $this->hasMany(CategoryRating::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function managedCategories()
    {
        return $this->hasMany(CategoryManager::class);
    }
}

