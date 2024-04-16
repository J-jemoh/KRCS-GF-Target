<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VP_DC extends Model
{
    use HasFactory;

    protected $fillable=[

'sno', 'month', 'Year', 'implementing_partner', 'region', 'county', 'subcounty', 'peer_educator', 'peer_name', 'facility', 'ward', 'disability', 'sex', 'age', 'phone_no', 'first_contact_date', 'enrol_date', 'hiv_status_at_enrollment', 'received_health_education', 'tested_hiv', 'frequency_of_hiv_test', 'hiv_status', 'started_on_art', 'currently_on_art', 'due_for_vl', 'received_vl_test', 'vl_copies', 'screened_for_tb', 'diagnosed_with_tb', 'started_tb_treatment', 'screened_for_sti', 'diagnosed_with_sti', 'treated_for_sti', 'initiated_on_prep', 'currently_on_prep', 'issued_with_condoms', 'tttended_of_pssg', 'reached_with_eban', 'experienced_violence', 'received_post_violence_support', 'programme_status', 'remarks'

    ];
}
