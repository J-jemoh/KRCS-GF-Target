<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetsIssued extends Model
{
    use HasFactory;
    protected $fillable=[
        'asset_id','user_id','region','sr_name','person_issued','person_contact','issue_date','condition','return_date','return_codition','returned_by'

    ];
    public function assets(){

           return $this->belongsTo(Assets::class,'asset_id','id');
    }

}
