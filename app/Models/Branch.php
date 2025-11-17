<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name', 'address'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
