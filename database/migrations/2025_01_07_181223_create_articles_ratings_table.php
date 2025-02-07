<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('articles_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('rating')->unsigned();
            $table->timestamps();
            $table->unique(['user_id', 'article_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles_ratings');
    }
}
