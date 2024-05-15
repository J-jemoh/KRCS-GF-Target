<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AYP_HCBF extends Model
{
    use HasFactory;

    protected $fillable=[
        'sno',
        'month',
        'year',
        'region',
        'county',
        'sub_county',
        'ward',
        'venue',
        'implementing_partner',
        'facilitator_1',
        'facilitator_2',
        'start_date',
        'end_date',
        'name',
        'age',
        'sex',
        'session1',
        'session2',
        'session3',
        'session4',
        'sssssion5',
        'session6',
        'session7',
        'make_up_session_date',
        'complete_sessions',
        'provided_condoms',
        'risk_assessment_r',
        'risk_assessment_c',
        'vmmc_r',
        'vmmc_c',
        'ovc_r',
        'ovc_c',
        'prc_r',
        'prc_c',
        'pss_r',
        'pss_c',
        'hts_r',
        'hts_c',
        'sti_screening_r',
        'sti_screening_c',
        'sti_treatment_r',
        'sti_treatment_c',
        'legal_aid_r',
        'legal_aid_c',
        'pep_r',
        'pep_c',
        'pmtct_r',
        'pmtct_c',
        'fp_r',
        'fp_c',
        'others_r',
        'others_c',
        'comments'
    ];
}
