<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbanService extends Model
{
    use HasFactory;

    protected $fillable=[

        'sno', 'month', 'year', 'region', 'counties', 'couple_code', 's1', 's2', 's3', 's4', 's5', 's6', 's7', 's8', 'make_up_sessions', 'complete_session', 'provide_with_condom', 'prep_r', 'prep_c', 'pep_r', 'pep_c', 'pss_r', 'pss_c', 'hts_r', 'hts_c', 'fp_r', 'fp_c', 'gbv_r', 'gbv_c', 'sti_r', 'sti_c', 'vmmc_r', 'vmmc_c', 'audit_r', 'audit_c', 'care_r', 'care_c', 'cervical_cancer_s_r', 'cervical_cancer_c', 'pmtct_r', 'pmtct_c', 'other_r', 'other_c', 'comments'

    ];
}
