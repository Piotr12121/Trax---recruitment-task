<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorize('action', Car::class);

        $validated = $request->validate([
            'year' => 'required|integer',
            'make' => 'required|string',
            'model' => 'required|string',
        ]);

        $car = new Car;
        $car->year = $validated['year'];
        $car->make = $validated['make'];
        $car->model = $validated['model'];
        $car->user_id = Auth::user()->id;

        try {
            $car->save();
        } catch (Exception $ex) {
            custom_logger($ex);
        }
    }

    /**
     * @param Request $request
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Request $request)
    {
        $this->authorize('action', Car::class);

        try {
            Car::find($request->id)->delete();
        } catch (Exception $ex) {
            custom_logger($ex);
        }
    }

    /**
     * @return array
     * @throws AuthorizationException
     */
    public function showAny(): array
    {
        $this->authorize('action', Car::class);

        $car = Car::cars();
        return ['data' => $car];
    }

    /**
     * @param Request $request
     * @return Builder[]|null
     * @throws AuthorizationException
     */
    public function show(Request $request): ?array
    {
        $this->authorize('action', Car::class);

        $car = Car::with('trips')->car($request->id);
        return ['data' => $car];
    }
}
