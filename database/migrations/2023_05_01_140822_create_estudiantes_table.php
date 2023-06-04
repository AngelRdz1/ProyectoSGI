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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->string('nie', 7)->primary();

            $table->string('nombre');
            $table->integer('numero_lista')->nullable();

            //Restricción de llave foránea: grados
            $table->unsignedBigInteger('grado_id')->nullable();
            $table->foreign('grado_id')->references('id')->on('grados')->onUpdate('cascade')->onDelete('cascade');
            /*$table->string('numero', 1)->nullable();
            $table->string('seccion', 1)->nullable();
            $table->foreign(['numero', 'seccion'])->references(['numero', 'seccion'])->on('grados')->onUpdate('cascade')->onDelete('cascade');*/

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
        Schema::dropIfExists('estudiantes');
    }
};
