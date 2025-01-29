<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory; // Utilisation du trait HasFactory pour la création de modèles via des factories

    // Déclaration des attributs qui peuvent être affectés en masse
    protected $fillable = [
        'user_id', // L'ID de l'utilisateur qui a créé l'article
        'issue_id', // L'ID du numéro auquel appartient l'article
        'category_id', // L'ID de la catégorie de l'article
        'title', // Le titre de l'article
        'content', // Le contenu de l'article
        'status', // Le statut de l'article (par exemple, proposé, publié, etc.)
        'visibility', // La visibilité de l'article (public, privé, etc.)
    ];

    // Relation : un article appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class); // La clé étrangère est user_id
    }

    // Relation : un article appartient à un numéro
    public function issue()
    {
        return $this->belongsTo(Issue::class); // La clé étrangère est issue_id
    }

    // Relation : un article appartient à une catégorie
    public function category()
    {
        return $this->belongsTo(Category::class); // La clé étrangère est category_id
    }

    // Relation : un article a plusieurs évaluations (notes)
    public function ratings()
    {
        return $this->hasMany(ArticleRating::class); // Lien avec le modèle ArticleRating
    }

    // Relation : un article a plusieurs conversations associées
    public function conversations()
    {
        return $this->hasMany(Conversation::class); // Lien avec le modèle Conversation
    }

    // Relation : un article a plusieurs statistiques (par exemple, vues, likes)
    public function statistics()
    {
        return $this->hasMany(Statistic::class); // Lien avec le modèle Statistic
    }
}
