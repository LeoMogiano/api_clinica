<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaMedica extends Model
{
    use HasFactory;

    protected $table ='historias_medicas';

    protected $fillable = [
        'antmed_fam',
        'antmed_pers',
        'medis_act',
        'alergias',
        'h_enfermedades',
        'h_cirugias',
        'salud_actual',
        'notas',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
