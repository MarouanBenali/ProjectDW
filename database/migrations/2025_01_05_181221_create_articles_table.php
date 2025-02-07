<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('numero')->nullable();
            $table->enum('numero_published',['published', 'unpublished'])->default('unpublished');
            $table->string('title');
            $table->string('image');
            $table->text('intro')->nullable();
            $table->enum('status', ['Refus', 'En cours', 'Retenu', 'Publie'])->default('En cours');
            $table->enum('access', ['public', 'private'])->default('public');  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
