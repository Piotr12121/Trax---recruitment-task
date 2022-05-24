<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the logged in user can perform any action with car
     *
     * @return bool
     */

    public function action(): bool
    {
        return Auth::check();
    }
}
