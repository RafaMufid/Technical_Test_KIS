<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use hasFactory;
    protected $table = 'tbl_participants';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama',
        'pin',
    ];

    public function reasons(){
        return $this->hasMany(ParticipantReason::class, 'id_peserta', 'id');
    }
}