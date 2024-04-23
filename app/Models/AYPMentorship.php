<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AYPMentorship extends Model
{
    use HasFactory;

    protected $fillable=[

        'sno',
        'user_id',
        'unique_id',
        'month',
        'year',
        'region',
        'counties',
        'subcounty',
        'ward',
        'venue',
        'implementingpartner',
        'nementor1',
        'nementor2',
        'cohortnumber',
        'menteename',
        'dob',
        'age',
        'sex',
        'phonenumber',
        'village',
        'uniqueidentifier',
        'start_date',
        'end_date',
        'session1',
        'session2',
        'session3',
        'session4',
        'session5',
        'makeup_session',
        'complete_session',
        'services_referred',
        'services_accessed',
        'attended_outreach',
        'attended_ebi',
        'comments'

    ];
}
