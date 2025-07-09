<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyHighlights extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[

        'user_id','region','start_date','end_date','key_highlights','key_action_points','hq_support','next_month_plans','supervisor_comments','status'

    ];
    public function user(){
    return $this->belongsTo(User::class);
    }
    public function highlightComments(){
    return $this->hasMany(HighlightComments::class, 'monthlyhighlights_id');
    }


}
