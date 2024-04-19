<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCS extends Model
{
    use HasFactory;

    protected $fillable=[

        'unique_identifier',
        'sno',
        'month',
        'year',
        'region',
        'sr',
        'county',
        'sub_county',
        'health_facility',
        'community_tracing_focal_person',
        'ccc_number',
        'dob',
        'age',
        'sex',
        'pregnant_lactating',
        'missed_appointment_date',
        'date_listed_as_defaulter',
        'date_of_community_tracing',
        'tracing_outcome',
        'date_of_community_tracing_2',
        'tracing_outcome_2',
        'date_of_community_tracing_3',
        'tracing_outcome_3',
        'linked_facility',
        'date_received_at_linked_facility',
        'remarks',

    ];
}
