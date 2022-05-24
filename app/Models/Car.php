<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Car extends Model
{
    /**
     * @var string
     */
    protected $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'make', 'model', 'year',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id', 'created_at', 'updated_at'
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'trip_count',
        'trip_miles'
    ];

    /**
     * @return int
     */
    public function getTripCountAttribute()
    {
        return $this->trips()->count();
    }

    /**
     *
     * Get the trips for car.
     */
    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * @return int|mixed
     */
    public function getTripMilesAttribute()
    {
        return $this->trips()->sum('miles');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeCars($query)
    {
        return $query->where('user_id', Auth::user()->id)->get()->makeHidden(['trip_count', 'trip_miles']);
    }

    /**
     *
     * Get the user of the car.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeCar($query, $id)
    {
        return $query->find(Auth::user()->id)->makeHidden('trips');
    }

}
