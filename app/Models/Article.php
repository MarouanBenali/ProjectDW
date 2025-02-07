<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'numero',
        'numero_published',
        'intro',
        'image',
        'access',
        'title',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function ratings()
    {
        return $this->hasMany(ArticleRating::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}