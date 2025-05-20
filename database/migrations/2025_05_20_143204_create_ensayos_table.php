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
        Schema::create('ensayos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('lugar')->constrained('localizaciones')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->date('fecha');
            $table->time('horario_inicio');
            $table->time('horario_fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ensayos');
    }
};
