<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docentes';

    protected $fillable = [
        'nombre'
    ];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function materia() {
        return $this->hasOne(Materia::class);
    }

    public function grado() {
        return $this->hasOne(Grado::class);
    }
}
