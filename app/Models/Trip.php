<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    /**
     * @var string
     */
    protected $table = 'trips';

    /**
     * @var string[]
     */
    protected $fillable = [
        'date', 'miles', 'car_id',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'created_at', 'updated_at', 'laravel_through_key', 'car_id'
    ];

    /**
     *
     * Get the user of the car.
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class)->select(array('id', 'make', 'model', 'year'));
    }
}

