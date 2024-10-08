<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TwilioService; // Ajout du service Twilio
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $twilio;

    // Injecter le service Twilio dans le constructeur
    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }

    public function submit(Request $request)
    {
        // Valider le numéro de téléphone
        $request->validate([
            'phone' => 'required|numeric|min:10'
        ]);

        // Rechercher ou créer un utilisateur avec ce numéro de téléphone
        $user = User::firstOrCreate([
            'phone' => $request->phone
        ]);

        if (!$user) {
            return response()->json(["message" => "Impossible de traiter un utilisateur avec ce numéro de téléphone."], 401);
        }

        // Générer un code de connexion à 6 chiffres
        $loginCode = rand(100000, 999999);

        // Sauvegarder le code dans la base de données (ici dans l'utilisateur)
        $user->update([
            'login_code' => $loginCode
        ]);

        // Envoyer le code via SMS avec Twilio
        $message = "Votre code de connexion est : " . $loginCode;
        $this->twilio->sendSms($user->phone, $message);

        // Retourner la réponse JSON confirmant l'envoi du code
        return response()->json(['message' => 'Le code de connexion a été envoyé par SMS avec succès.']);
    }

    public function verify(Request $request)
    {
        // Valider les données
        $request->validate([
            'phone' => 'required|numeric|min:10',
            'login_code' => 'required|numeric|between:111111,999999'
        ]);

        // Rechercher l'utilisateur avec le numéro de téléphone et le code de connexion
        $user = User::where('phone', $request->phone)
            ->where('login_code', $request->login_code)
            ->first();

        // Si l'utilisateur est trouvé
        if ($user) {
            // Réinitialiser le code de connexion à null pour qu'il ne puisse plus être utilisé
            $user->update([
                'login_code' => null
            ]);

            // Créer et retourner un token d'authentification (optionnel si tu utilises Laravel Sanctum par exemple)
            return response()->json([
                'token' => $user->createToken($request->login_code)->plainTextToken,
                'message' => 'Connexion réussie.'
            ]);
        }

        // Si aucun utilisateur n'est trouvé (code ou numéro invalide)
        return response()->json(['message' => 'Code de vérification invalide'], 401);
    }
}
