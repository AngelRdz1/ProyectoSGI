<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias';

    protected $fillable = [
        'nombre',
        'docente_id'
    ];

    public function docente() {
        return $this->belongsTo(Docente::class);
    }

    public function evaluaciones() {
        return $this->hasMany(Evaluacion::class);
    }
}
