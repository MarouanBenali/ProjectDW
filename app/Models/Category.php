<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'bgImg',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function ratings()
    {
        return $this->hasMany(CategoryRating::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function managers()
    {
        return $this->hasMany(CategoryManager::class);
    }
}