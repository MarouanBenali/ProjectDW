<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{
    // Méthode pour récupérer l'image de profil de l'utilisateur connecté
    public function getProfilePicture(){
        // Vérifier si l'utilisateur est authentifié
        if (Auth::check()) {
            $user = Auth::user(); // Récupérer l'utilisateur authentifié

            // Vérifier si l'utilisateur a une image de profil, sinon utiliser une image par défaut basée sur son sexe
            $profilePicture = $user->profile_picture
                ? asset('storage/' . $user->profile_picture) // Si l'image de profil existe, la récupérer
                : asset('img/user_' . $user->gender . '.png'); // Sinon, utiliser une image par défaut

            // Retourner l'image de profil, le rôle et le nom de l'utilisateur en majuscules
            return response()->json([
                'profile_picture' => $profilePicture, // Image de profil
                'role' => $user->role, // Rôle de l'utilisateur
                'userName' =>  strtoupper($user->name), // Nom de l'utilisateur en majuscules
            ]);
        }

        // Si l'utilisateur n'est pas authentifié, retourner une image par défaut et un message de connexion
        return response()->json([
            'profile_picture' => asset('img/user_other.png'), // Image par défaut pour les utilisateurs non connectés
            'role' => null, // Pas de rôle pour les utilisateurs non connectés
            'userName' => 'CONNEXION', // Afficher "CONNEXION" comme nom d'utilisateur
        ]);
    }
}
