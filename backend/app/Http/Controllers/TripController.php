<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'origine' => 'required',
            'destination' => 'required',
            'destination_name' => 'required',
        ]);

        return $request->user()->trip()->create($request->only([
            'origine',
            'destination',
            'destination_name',
        ]));
    }

    public function show(Request $request, Trip $trip){
        //Cette condition vérifie si l'utilisateur authentifié (celui qui a fait la requête)
        // est le créateur du voyage.
        if ($trip->user->id === $request->user()->id){
            return $trip;
        }

        if ($trip->driver &&  $request->user()->driver->id){
            if ($trip->driver->id === $request->user()->driver->id){
                return $trip;
            }
        }

        return response()->json(['message'=>"ce voyage n'a pas été trouvé"], 404);
    }

    public function accept(Request $request, Trip $trip){
        // le conducteur accepte le voyage
        $request->validate([
            'driver_location' => 'required'
        ]);

        $trip->update([
            'driver_id' => $request->user()->id,
            'driver_location' => $request->driver_location
        ]);
    }

    public function start(Request $request, Trip $trip){
        // le conducteur commence le voyage
    }

    public function end(Request $request, Trip $trip){
        // le conducteur termine le voyage
    }

    public function location(Request $request, Trip $trip){
        // mise à jour de la localisation du conducteur
    }
}
