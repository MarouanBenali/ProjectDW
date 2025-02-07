<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    public function run()
    {
        $comments = [
            "Très intéressant, merci pour cet article !",
            "J'ai appris beaucoup de choses grâce à cet article.",
            "Un sujet fascinant, merci pour ce partage !",
            "J'aimerais en savoir plus sur ce sujet.",
            "Excellente analyse, bien détaillée !",
            "Il y a des points à approfondir, mais globalement c'est bien !",
            "Superbe explication, merci !",
            "Je ne suis pas totalement d'accord, mais c'est intéressant.",
            "Merci pour cet article très instructif !",
            "Un point de vue pertinent sur la question.",
            "C'était un article très bien écrit, merci pour ces informations.",
            "L'approfondissement de certains aspects serait utile, mais bonne introduction.",
            "Ce sujet m'intéresse vraiment, je vais lire plus sur le sujet.",
            "Le contenu est bien structuré, mais certaines sections peuvent être améliorées.",
            "Merci de partager vos connaissances, c'était une lecture agréable.",
            "L'exemple utilisé dans cet article est parfait pour comprendre le sujet.",
            "J'ai trouvé cet article très utile, continuez à écrire plus de contenu comme celui-ci.",
            "Un article vraiment inspirant, merci beaucoup !",
            "Je pense que ce sujet mérite plus d'attention, il est sous-estimé.",
            "Bravo pour cet article, je le recommande vivement !",
            "C'était une lecture enrichissante, mais quelques points méritent des clarifications."
        ];
        
        $users = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

        for ($article_id = 1; $article_id <= 100; $article_id++) {
            $numComments = rand(7, 15);

            for ($i = 0; $i < $numComments; $i++) {
                Conversation::create([
                    'article_id' => $article_id,
                    'user_id' => $users[array_rand($users)],
                    'content' => $comments[array_rand($comments)],
                ]);
            }
        }
    }
}
