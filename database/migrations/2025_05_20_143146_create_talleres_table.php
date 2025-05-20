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
        Schema::create('talleres', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');

            $table->float('costo_mensual');
            $table->string('edad');
            $table->string('dias_de_clase')->comment('lunes, martes, etc');
            $table->string('horario_maniana')->nullable();
            $table->string('horario_tarde')->nullable();
            $table->foreignId('instructor_id')->constrained('instructores')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('lugar_id')->constrained('localizaciones')
                ->onDelete('restrict')->onUpdate('cascade');
                $table->foreignId('categoria_id')->constrained('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talleres');
    }
};
