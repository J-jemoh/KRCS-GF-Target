<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PMTCT extends Model
{
    use HasFactory;

    protected $fillable=[

        'sno',
        'user_id',
        'month',
        'year',
        'region',
        'sr_name',
        'county',
        'sub_county',
        'care_facility',
        'name',
        'mother_ccc_no',
        'dob',
        'age',
        'phone_number',
        'lactating',
        'pregnant',
        'no_of_anc_visits',
        'delivery_at_facility',
        'hei_id',
        'hei_dob',
        'age_in_months',
        'sex',
        'date_of_enrolment',
        'received_prophylaxis_at_6_wks',
        'dna_pcr_status_at_6_8_wks',
        'dna_pcr_status_at_6_months',
        'dna_pcr_status_at_12_months',
        'test_result_of_ab_at_18_months',
        'confirm_test_results',
        'linked_facility',
        'hei_ccc_number',
        'final_outcome',
        'hei_remarks',
        'reached_by_expert_mother',
        'attended_pssg',
        'art_status',
        'due_for_vl',
        'vl_done',
        'received_vl_result',
        'vl_copies',
        'screened_for_sti',
        'diagonsed_for_sti',
        'treated_for_sti',
        'cervical_cancer_screening',
        'cacx_results',
        'treated_for_cacx',
        'reached_with_fp_information',
        'screened_for_pregnancy_intention',
        'currently_on_fp',
        'screened_for_tb',
        'tb_diagnosis',
        'reffered_for_tb_treatment',
        'experienced_violence',
        'received_post_violence_support',
        'remarks_comments',
        'unique_identifier'


    ];
}
