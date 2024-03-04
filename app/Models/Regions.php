<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regions extends Model
{
    use HasFactory,SoftDeletes;

    protected$fillable=[
        'region_code',
        'user_id',
        'regionName'
    ];
}
