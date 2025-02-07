<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Notification;

class UserController extends Controller
{
    // Méthode pour récupérer l'image de profil de l'utilisateur connecté
    public function getInfoUser()
    {
        if (Auth::check()) {
            $user = Auth::user(); // Récupérer l'utilisateur authentifié
            $profilePicture = $user->profile_picture
                ? asset('storage/' . $user->profile_picture) 
                : asset('img/user_' . $user->gender . '.png'); // Image par défaut

            return response()->json([
                'profile_picture' => $profilePicture,
                'role' => $user->role,
                'userName' => strtoupper($user->name),
            ]);
        }

        return response()->json([
            'profile_picture' => asset('img/user_other.png'),
            'role' => null,
            'userName' => 'CONNEXION',
        ]);
    }

    // Méthode pour mettre à jour l'image de profil de l'utilisateur connecté
    public function updatePicture(Request $request)
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            $request->validate([
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
            $user->save();

            // Envoi de notification à l'utilisateur lorsque l'image de profil est mise à jour
            $this->sendNotification($user->id, 'Votre image de profil a été mise à jour.');

            return redirect()->back();
        }

        return redirect()->back();
    }

    // Méthode pour attribuer un rôle à un utilisateur
    public function assignRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $oldRole = $user->role;
        $user->role = $request->input('role');
        $user->save();

        // Envoi de notification à l'utilisateur lorsque son rôle est changé
        $this->sendNotification($user->id, "Votre rôle a été changé de {$oldRole} à {$user->role}.");

        return redirect()->back();
    }

    // Méthode pour bannir ou débannir un utilisateur
    public function DeBanUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = !$user->is_banned; // Inverser l'état de bannissement
        $user->save();

        // Envoi de notification à l'utilisateur lorsque son statut de bannissement est modifié
        $status = $user->is_banned ? 'banni' : 'débanni';
        $this->sendNotification($user->id, "Votre compte a été {$status}.");

        return redirect()->back();
    }

    // Méthode pour envoyer une notification
    public function sendNotification($userId, $message)
    {
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
            'type' => 'admin', // Type de notification : administrateur
        ]);
    }
}
