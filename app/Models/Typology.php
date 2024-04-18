<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    use HasFactory;
    protected $casts = [
            'tca' => 'string',
        ];

    protected $fillable=[
        'sno',
        'user_id',
        'peer_educator_code',
        'received_peer_education',
        'clinical_services',
        'hiv_tested',
        'hts_service_point',
        'hiv_test_freq',
        'hiv_status',
        'self_test_hiv',
        'pre_art',
        'art_started',
        'currently_art',
        'current_facility_care',
        'hiv_care_outcome',
        'art_outcome',
        'due_vl',
        'vl_done',
        'vl_result_received',
        'att_vl_suppression',
        'tb_screened',
        'tb_diagonised',
        'tb_treatment_started',
        'hiv_exposure_72hr',
        'pep_72',
        'completed_pep',
        'condom_nmbr_reqr',
        'condom_distributed_nmbr',
        'condom_prov_as_per_need',
        'lubricant_req_nbr',
        'lubricant_distr_nbr',
        'lubricant_prov_per_need',
        'nssp_nmbr',
        'nssp_distributed_nbr',
        'received_nssp_need',
        'hepc_screened',
        'hepc_status',
        'hepc_treated',
        'hepb_screening',
        'hepb_status',
        'on_hepb_treatment',
        'hepb_vaccination',
        'sti_screened',
        'sti_diagnosied',
        'sti_treated',
        'drug_abuse_screened',
        'prep_initated',
        'on_prep',
        'modern_fp_services',
        'rssh',
        'ebi',
        'exp_violence',
        'post_violence_support',
        'program_status',
        'tca',
        'month',
        'year',
        'region'
    ];
        public function demographic()
    {
       return $this->belongsTo(Demographics::class, 'unique_identifier');
    }
}
