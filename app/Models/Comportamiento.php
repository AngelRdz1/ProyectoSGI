<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function boleta() {
        return $this->belongsTo(Boleta::class);
    }
}
