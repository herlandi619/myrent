<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'branch_id',
        'item_id',
        'start_time',
        'end_time',
        'total_price',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
