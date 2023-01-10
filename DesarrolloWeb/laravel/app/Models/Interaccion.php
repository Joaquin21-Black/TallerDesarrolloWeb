<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{

    public $table = "interaccion";

    public $fillable = [
        'perro_interesado_id',
        'perro_candidato_id',
        'preferencia',
    ];

    use HasFactory;

    public function perrosInteresados ()
    {
        return $this->belongsTo(Perro::class, 'perro_interesado_id');
    }

    public function perrosCandidato ()
    {
        return $this->belongsTo(Perro::class, 'perro_candidato_id');
    }
}
