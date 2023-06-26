<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergencia extends Model
{
    use HasFactory;

    protected $table ='emergencias';

    protected $fillable = [
        'detalle_fin',
        'diagnostico',
        'estado',
        'fecha',
        'gravedad',
        'hora',
        'motivo',
        'observacion',
        'user_id'
    ];

    protected $dates = [
        'fecha',
        'hora'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
