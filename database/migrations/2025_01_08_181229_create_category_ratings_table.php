<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('category_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('rating')->unsigned();
            $table->timestamps();

            $table->unique(['user_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_ratings');
    }
}
