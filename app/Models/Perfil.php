<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla en la BD
     */
    protected $table = 'perfiles';   // <-- ¡IMPORTANTE!

    protected $fillable = [
        'user_id','sexo','fecha_nacimiento','estado_civil','nivel_instruccion',
        'carga_familiar','profesion','lugar_labora','condicion_laboral',
        'estatus_laboral','centro_votacion','tiene_discapacidad','condicion_salud'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}