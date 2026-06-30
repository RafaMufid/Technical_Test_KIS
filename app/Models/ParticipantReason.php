<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantReason extends Model
{
    use hasFactory;
    protected $table = 'tbl_participant_reason';

    protected $fillable = [
        'id_peserta',
        'status',
        'catatan',
        'alasan'
    ];

    public function participant(){
        return $this->belongsTo(Participant::class, 'id_peserta', 'id');
    }
}
