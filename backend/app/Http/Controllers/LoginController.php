<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function submit(Request $request){
        //validate the phone number
        $request->validate([
            'phone' => 'required|numeric|min:10|max:10'
        ]);

        //find or create a user model
        $user = User::firstOrCreate([
            'phone' => $request->phone
        ]);

        if (!$user){
            return response()->json(["message"=> "n'a pas pu traiter un utilisateur avec ce numéro de téléphone."], 401);
        }

        // send the user a one-time use code
        $user->notify();

        //return back the reponse
    }
}
