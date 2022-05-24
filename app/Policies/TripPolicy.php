<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TripPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the logged in user can perform any action with trip
     *
     * @return bool
     */

    public function action(): bool
    {
        return Auth::check();
    }
}
