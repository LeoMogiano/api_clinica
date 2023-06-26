<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    use HasFactory;

    protected $table = 'analisis';
    
    protected $fillable = ['descripcion', 'motivo', 'fecha', 'hora', 'emergencia_id'];

    protected $dates = [
        'fecha',
        'hora'
    ];

    public function emergencia()
    {
        return $this->belongsTo(Emergencia::class, 'emergencia_id');
    }
}
