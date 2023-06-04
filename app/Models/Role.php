<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'considera');
    }

    public function permisos() {
        return $this->belongsToMany(Permiso::class, 'contiene');
    }
}
