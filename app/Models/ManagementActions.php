<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ManagementActions extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[

        'user_id','duration','region','category','sr_name','key_issues','root_cause','mitigation_action','date','sr_response','status_update','reference_documents','sr_attachmemts','pr_attachments','status'
    ];
     protected $casts = [
        'reminder_sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
}
