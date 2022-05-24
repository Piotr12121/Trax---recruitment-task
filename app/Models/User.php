<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeTrips($query)
    {
        return $query->find(Auth::user()->id)->trips->sortByDesc('date');
    }

    /**
     *
     * Get the cars for the user.
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    /**
     *
     * Get the trips for the user.
     */
    public function trips(): HasManyThrough
    {
        return $this->hasManyThrough(Trip::class, Car::class);
    }


}
