<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Grado extends Model
{
    use HasFactory;

    protected $table = 'grados';

    protected $fillable = [
        'numero',
        'seccion',
        'cant_ninos',
        'cant_ninas',
        'docente_id'
    ];

    public static function getData(){
        return DB::select('SELECT g.numero, g.seccion, g.cant_ninos, g.cant_ninas, d.nombre, g.id FROM grados g
                JOIN docentes d ON d.id = g.docente_id');
    }
}
