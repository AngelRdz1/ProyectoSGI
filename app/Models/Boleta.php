<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Boleta extends Model
{
    use HasFactory;

    protected $table = 'boletas';

    protected $fillable = [
        'mes',
        'anio',
        'numero',
        'seccion',
    ];

    public static function getDataPromedioFinal(){
        return DB::select('SELECT b.id, b.accion, b.descripcion, b.fecha_realizacion, u.name AS name_usuario
                          FROM bitacoras b
                          JOIN users u ON b.user_id = u.id');
    }

    public function evaluaciones() {
        return $this->hasMany(Evaluacion::class);
    }

    public function comportamientos() {
        return $this->hasMany(Comportamiento::class);
    }

    public function grado() {
        return $this->belongsTo(Grado::class);
    }
    
    public static function getDataBoleta($id){

        $query = DB::select('SELECT e.nie, m.id as idMateria, m.nombre as nombreMateria, b.mes,
            CASE
                WHEN eva.nombre LIKE "recuperacion%" THEN CONCAT(eva.nombre)
                ELSE "Evaluación"
            END as tipoEvaluacion,
            SUM(CASE WHEN eva.nombre LIKE "recuperacion%" THEN eva.nota ELSE eva.nota * eva.porcentaje END) as sumaNotas
            FROM estudiantes e
                JOIN evaluaciones eva ON e.nie = eva.nie_estudiante
                JOIN boletas b ON eva.boleta_id = b.id
                JOIN materias m ON eva.materia_id = m.id
                WHERE e.nie = ?
            GROUP BY e.nie, m.nombre, b.mes, m.id, tipoEvaluacion
            ORDER BY STR_TO_DATE(b.mes, "%M"), tipoEvaluacion', [$id]);
        return $query;
    }
}
