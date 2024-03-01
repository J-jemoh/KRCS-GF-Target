<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Target extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'module',
        'quater',
        'year',
        'reqion',
        'sr',
        'county',
        'defined_q1',
        'defined_q2',
        'defined_target',
        'defined_sem',
        'defined_performance',
        'hts_q1',
        'hts_q2',
        'hts_target',
        'hts_sem',
        'hts_performance',
        'prep_q1',
        'prep_q2',
        'prep_target',
        'prep_total',
        'prep_performance',
        'user_id',
    ];
}
