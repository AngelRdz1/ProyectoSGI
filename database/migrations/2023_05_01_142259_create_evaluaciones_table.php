<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();

            //Restricción de llave foránea: estudiantes
            $table->string('nie_estudiante');
            $table->foreign('nie_estudiante')->references('nie')->on('estudiantes')->onUpdate('cascade')->onDelete('restrict');

            //Restricción de llave foránea: materias
            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias')->onUpdate('cascade')->onDelete('cascade');

            //Restricción de llave foránea: boletas
            $table->unsignedBigInteger('boleta_id');
            $table->foreign('boleta_id')->references('id')->on('boletas')->onUpdate('cascade')->onDelete('cascade');

            $table->string('nombre', 25);
            $table->float('porcentaje', 8, 3, false);
            $table->float('nota', 8, 2, false);

            /*$table->timestamps('fecha_creacion');
            $table->timestamps('fecha_modificacion');*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};
