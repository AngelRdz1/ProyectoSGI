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
        Schema::create('grados', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 1);
            $table->string('seccion', 1);
            //$table->primary(['numero', 'seccion']);

            $table->integer('cant_ninos');
            $table->integer('cant_ninas');

            //Restricción de llave foránea: docentes
            $table->unsignedBigInteger('docente_id')->nullable();
            $table->foreign('docente_id')->references('id')->on('docentes')->onUpdate('cascade')->onDelete('restrict');

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
        Schema::dropIfExists('grados');
    }
};
