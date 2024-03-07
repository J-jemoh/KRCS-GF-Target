<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QPMM extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'user_id',
        'sno',
        'region',
        'target_group',
        'indicators',
        'pt_quater_1',
        'pt_quater_2',
        'pt_quater_3',
        'pt_quater_4',
        'pt_quater_5',
        'pt_quater_6',
        'pt_quater_7',
        'pt_quater_8',
        'pt_quater_9',
        'pt_quater_10',
        'pt_quater_11',
        'pt_quater_12',
        'pt_total',
        'pa_quater1',
        'pa_quater2',
        'pa_quater3',
        'pa_quater4',
        'pa_quater5',
        'pa_quater6',
        'pa_quater7',
        'pa_quater8',
        'pa_quater9',
        'pa_quater10',
        'pa_quater11',
        'pa_quater12',
        'pa_total',
        'percent',

    ];
}
