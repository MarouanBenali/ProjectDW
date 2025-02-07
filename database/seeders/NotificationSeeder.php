<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $messages = [
            'Vous avez un nouveau commentaire sur votre article.',
            'Votre article a reçu un like.',
            'Un nouvel article a été publié dans votre catégorie préférée.',
            'Votre commentaire a reçu une réponse.',
            'Vous avez une nouvelle mention dans un article.',
        ];
        $types = ['comment', 'like', 'promotion'];

        foreach ($users as $user) {
            $numNotifications = rand(2, 5); 

            for ($i = 0; $i < $numNotifications; $i++) {
                Notification::create([
                    'user_id' => $user->id,
                    'message' => $messages[array_rand($messages)],
                    'type' => $types[array_rand($types)],
                    'is_read' => (bool)rand(true, false),
                ]);
            }
        }
    }
}
