<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comportamiento extends Model
{
    use HasFactory;

    protected $table = 'comportamientos';

    protected $fillable = [
        'tipo',
        'nombre',
        'valor',
        'boleta_id'
    ];

    public static function getData(){
        return DB::select('SELECT c.tipo, c.nombre, c.valor, b.mes FROM comportamientos c JOIN boletas b ON c.boleta_id = b.id');
    }

    public function boleta() {
        return $this->belongsTo(Boleta::class);
    }
}
