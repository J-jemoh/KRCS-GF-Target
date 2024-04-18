<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demographics extends Model
{
    use HasFactory;
    protected $table = 'demographics';

    protected $fillable=[
            'user_id',
            'sno',
            'month',
            'year',
            'region',
            'county',
            'sr_name',
            'kp_name',
            'hotspot',
            'hotspot_typology',
            'other_hotspot',
            'subcounty',
            'ward',
            'kp_phone',
            'kp_type',
            'uic',
            'age',
            'yob',
            'sex',
            'first_contact_date',
            'enrol_date',
            'hiv_status_enrol',
            'peer_educator',
            'peer_educator_code',
    ];
    public function typology()
    {
      return $this->hasOne(Typology::class,'unique_identifier', 'uic');
    }
}
