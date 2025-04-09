<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentUpdate extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id', 'department', 'week', 'start_date', 'end_date', 
        'achievements', 'work_plan', 'key_risks', 'comments', 'matters_arising'
    ];
}
