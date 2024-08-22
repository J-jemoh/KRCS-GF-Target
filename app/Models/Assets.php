<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assets extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[

        'asset_tag_id','description','serial_no','purchase_date','cost','purchased_from','brand','model','category','user_id','status'
    ];

    public function assetsIssued(){

       return $this->hasMany(AssetsIssued::class,'asset_id');
    }
}
