<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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
        'comment',
        'abuse_date'
    ];
    // protected $dates = ['abuse_date'];
    // // Define a mutator to set the format when setting the date attribute
    //  public function setAbuseDateAttribute($value)
    // {
    //     // Try parsing the date using different formats
    //     $formats = ['yyyy-mmm-dd', 'dd-mm-yyyy','dd-mm-yy']; // Add more formats as needed
    //     foreach ($formats as $format) {
    //         $date = Carbon::createFromFormat($format, $value);
    //         if ($date !== false && $date->format($format) === $value) {
    //             // Set the abuse_date attribute to the parsed date in Y-m-d format
    //             $this->attributes['abuse_date'] = $date->format('Y-m-d');
    //             return; // Exit loop once a valid format is found
    //         }
    //     }

    //     // If no valid date is found, handle the error
    //     // For example, you might throw an exception or log the error
    //     // For now, we're just setting the attribute to the original value
    //     $this->attributes['abuse_date'] = $value;
    // }

}
