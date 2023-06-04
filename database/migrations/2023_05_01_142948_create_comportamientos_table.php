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
        Schema::create('comportamientos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 100);
            $table->string('nombre', 100);
            $table->float('valor', 8, 2, false);

            //Restricción de llave foránea: boletas
            $table->unsignedBigInteger('boleta_id');
            $table->foreign('boleta_id')->references('id')->on('boletas')->onUpdate('cascade')->onDelete('restrict');

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
        Schema::dropIfExists('comportamientos');
    }
};
