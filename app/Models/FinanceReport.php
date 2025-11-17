<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;

class FinanceReport extends Model
{
    protected $fillable = [
        'branch_id',
        'date',
        'total_income'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
