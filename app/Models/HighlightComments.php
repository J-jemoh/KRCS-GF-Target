<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HighlightComments extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'monthlyhighlights_id','supervisor_id','comment'

    ];
    public function monthlyHighlight()
{
    return $this->belongsTo(MonthlyHighlight::class, 'monthlyhighlights_id');
}

}
