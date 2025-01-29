<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'issue_date',
        'status',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}