<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PfTarget extends Model
{
    use HasFactory;

    protected $fillable=[

         'user_id', 'sno', 'coverage_indicator', 'baseline_dec', 'june_target', 'period1', 'period2', 'period3', 'period4', 'period5', 'period6',
    ];
}
