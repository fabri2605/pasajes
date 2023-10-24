<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->string('EVENTO', 25);
            $table->string('CUIL', 11);
            $table->string('TARJETA', 10);
            $table->integer('CANTIDAD');
            $table->float('TARIFA', 6);
            $table->integer('IMPORTE');
            $table->string('TRAMO', 40);
            $table->date('FECHA');
            $table->integer('LATITUD');
            $table->integer('LONGITUD');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
