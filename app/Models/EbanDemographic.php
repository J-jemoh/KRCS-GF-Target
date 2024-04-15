<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbanDemographic extends Model
{
    use HasFactory;

    protected $fillable=[

        'sno', 'month', 'year', 'region', 'counties', 'sub_county', 'ward', 'site_name', 'implementing_partner', 'facilitator_i', 'facilitator_ii', 'group_no_name', 'start_date', 'end_date', 'couple_code', 'participant_name', 'age', 'sex', 'hiv_status'

    ];
}
