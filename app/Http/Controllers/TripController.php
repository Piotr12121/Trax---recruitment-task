<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * @param Request $request
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorize('action', Trip::class);

        $validated = $request->validate([
            'date' => 'required|date',
            'car_id' => 'required|integer',
            'miles' => 'required|numeric',
        ]);

        $trip = new Trip;
        $trip->date = $validated['date'];
        $trip->car_id = $validated['car_id'];
        $trip->miles = $validated['miles'];
        $trip->total = miles_calculator($trip);

        try {
            $trip->save();
        } catch (\Exception $ex) {
            custom_logger($ex);
        }
    }

    /**
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showAny()
    {
        $this->authorize('action', Trip::class);

        $trips = User::with('trips.car')->trips(); //done
        return ['data' => $trips];
    }
}
