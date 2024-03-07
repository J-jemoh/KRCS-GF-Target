<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GC7Coverage extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'county',
        'dhts',
        'tcs',
        'pmtct',
        'ayp',
        'msm',
        'fsw',
        'tg',
        'pwid',
        'hrg',
        'ff',
        'truckers',
        'dc',
        'prison',
        'total_program',
        'user_id',
        'sno',

    ];
}
