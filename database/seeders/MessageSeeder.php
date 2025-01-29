<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $conversations = Conversation::all();
        $users = User::where('role', 'subscriber')->get();

        foreach ($conversations as $conversation) {
            for ($i = 1; $i <= 30; $i++) {
                Message::create([
                    'conversation_id' => $conversation->id,
                    'user_id' => $users->random()->id,
                    'content' => "This is message $i in conversation {$conversation->id}.",
                ]);
            }
        }
    }
}