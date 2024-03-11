<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GBV extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'user_id',
        'sno',
        'year',
        'quater',
        'region',
        'sr_name',
        'county',
        'subcounty',
        'ward',
        'village',
        'report_month',
        'paralegal',
        'bname',
        'dob',
        'age',
        'sex',
        'typology',
        'disability',
        'disability_type',
        'phone',
        'confidant_no',
        'abuse',
        'perpetrator',
        'legal_clinic',
        'litigation',
        'legal_counsel',
        'referral',
        'care_status',
        'comment'
    ];
}
