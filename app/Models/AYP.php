<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AYP extends Model
{
    use HasFactory;

    protected $fillable=[

        'user_id', 'sno', 'month', 'year', 'region', 'sr_name', 'county', 'subcounty', 'ward', 'reporting_month', 'outreach_date', 'outreach_venue', 'pe_name', 'peer_name', 'dob', 'age', 'sex', 'disabled', 'disability_type', 'phone','attended_ebi', 'attended_outreach', 'provided_health_edu', 'provided_srh_info', 'counseled_safe_behavior', 'family_planning_info', 'offered_fp_services', 'risk_assessment', 'iec_material_offered', 'tested_hiv', 'hiv_results', 'art_initiated', 'art_hf_linked_to', 'ccc_number', 'linked_to_cats', 'sti_screening', 'treated_sti', 'tb_screened', 'referred_tb_treatment', 'screened_sgbv', 'referred_sgbv_tx', 'cervical_cancer_screening', 'referred_cancer_treatment', 'offered_pep', 'offered_prep', 'offered_condoms', 'num_condoms_offered', 'post_rape_care_services', 'post_abortion_care', 'treated_other_ailments', 'if_yes_specify'

    ];
}
