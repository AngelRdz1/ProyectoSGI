<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias';

    protected $fillable = [
        'id',
        'nombre',
        'docente_id'
    ];

    public static function getData(){
        return DB::select('SELECT m.id, m.nombre, d.nombre AS nombre_docente
                          FROM materias m
                          JOIN docentes d ON m.docente_id = d.id');
    }

    public function docente() {
        return $this->belongsTo(Docente::class);
    }

    public function evaluaciones() {
        return $this->hasMany(Evaluacion::class);
    }
}
