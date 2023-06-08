<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'bitacoras';
    
    protected $fillable = [
        'id',
        'accion',
        'descripcion',
        'fecha_realizacion',
        'user_id',
    ];

    public static function getData(){
        return DB::select('SELECT b.id, b.accion, b.descripcion, b.fecha_realizacion, u.name AS name_usuario
                          FROM bitacoras b
                          JOIN users u ON b.user_id = u.id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
