<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // La méthode up est utilisée pour créer la table "users"
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Crée une colonne "id" auto-incrémentée pour l'identifiant de l'utilisateur
            $table->string('name'); // Crée une colonne "name" pour le nom de l'utilisateur
            $table->string('email')->unique(); // Crée une colonne "email" unique pour l'adresse email de l'utilisateur
            $table->string('password'); // Crée une colonne "password" pour le mot de passe de l'utilisateur
            $table->string('phone_number')->nullable(); // Crée une colonne "phone_number" pour le numéro de téléphone, qui peut être nul
            $table->string('profile_picture')->nullable(); // Crée une colonne "profile_picture" pour l'image de profil, qui peut être nulle
            $table->date('date_of_birth')->nullable(); // Crée une colonne "date_of_birth" pour la date de naissance, qui peut être nulle
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // Crée une colonne "gender" avec des options : male, female, other, qui peut être nulle
            $table->string('preferred_language', 2)->default('fr'); // Crée une colonne "preferred_language" pour la langue préférée, avec une valeur par défaut "fr"
            $table->enum('role', ['subscriber', 'manager', 'editor'])->default('subscriber'); // Crée une colonne "role" pour le rôle de l'utilisateur, avec une valeur par défaut "subscriber"
            $table->tinyInteger('is_banned')->default(0); // Crée une colonne "is_banned" pour savoir si l'utilisateur est banni, avec une valeur par défaut 0 (non banni)
            $table->timestamps(); // Crée les colonnes "created_at" et "updated_at" pour suivre les dates de création et de mise à jour
        });
    }

    // La méthode down est utilisée pour supprimer la table "users" en cas de rollback
    public function down()
    {
        Schema::dropIfExists('users'); // Supprime la table "users" si elle existe
    }
};
