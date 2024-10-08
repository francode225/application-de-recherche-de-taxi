<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    //Cette fonction sert à afficher les informations de l'utilisateur
    // connecté et les informations du conducteur associé (s'il existe)
    public function show(Request $request){
        $user = $request->user();
        $user->load('driver');
        return $user;
    }

    public function update(Request $request){
        $request->validate([
            'annee' => 'required|numeric|between:2010,2025',
            'marque' => 'required',
            'modele' => 'required',
            //couleur : Doit être un texte sans chiffres ou caractères spéciaux
            'couleur' => 'required|alpha',
            'immatriculation' => 'required',
            'name' => 'required'
        ]);
        $user = $request->user();
        $user->update($request->only('name'));

        // // créé ou Met à jour ou crée les informations du conducteur associé à l'utilisateur
        $user->driver()->updateOrCreate($request->only([
            'annee',
            'marque',
            'modele',
            'couleur',
            'immatriculation'
        ]));

        // load() charge la relation driver associée à l'utilisateur
        $user->load('driver');

        return $user;

    }
}
