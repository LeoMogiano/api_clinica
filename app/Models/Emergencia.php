<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergencia extends Model
{
    use HasFactory;

    protected $table ='emergencias';

    protected $fillable = [
        'diagnostico',
        'estado',
        'fecha',
        'gravedad',
        'hora',
        'motivo',
        'observacion',
        'user_id',
        'medico_id'
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
