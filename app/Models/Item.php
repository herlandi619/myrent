<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'branch_id',
        'name',
        'type',
        'hourly_rate',
        'daily_rate',
        'status'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
