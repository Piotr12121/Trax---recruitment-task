<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

if (!function_exists('custom_logger')) {
    /**
     * @param $ex
     * @return void
     */
    function custom_logger($ex)
    {
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs\\custom.log'),
        ])->info(['info' => $ex]);
    }
}

if (!function_exists('miles_calculator')) {
    /**
     * @param $trip
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|null
     */
    function miles_calculator($trip)
    {
        return check_previous_trip() + $trip->miles;
    }
}

if (!function_exists('check_previous_trip')) {
    /**
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|null
     */
    function check_previous_trip()
    {
        $prev_trip = User::with('trips.car')
            ->find(Auth::user()->id)
            ->trips
            ->sortByDesc('date')
            ->first();

        if (!is_null($prev_trip))
            return $prev_trip->total;
        else
            return null;
    }
}


