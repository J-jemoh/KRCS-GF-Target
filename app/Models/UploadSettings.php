<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadSettings extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[

       'user_id','month','year','start_date','end_date'
    ];
}
