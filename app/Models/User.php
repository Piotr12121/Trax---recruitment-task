<?php

namespace App;

use App\Models\Car;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
     *
     * Get the cars for user.
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    /**
     *
     * Get all of the trips for user.
     */
    public function trips(): HasManyThrough
    {
        return $this->hasManyThrough(Trip::class, Car::class);
    }


}
