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
        Schema::create('casa_cultura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lugar')->constrained('localizaciones')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->string('nombre');
            $table->date('fecha');
            $table->time('horario_inicio');
            $table->time('horario_fin');
            $table->string('persona_responsable');
            $table->char('persona_responsable_telefono', 10);
            $table->boolean('firma_contrato_recepcion');
            $table->boolean('reservado');
            $table->enum('estado', ['Aprobado', 'Rechazado', 'Pendiente']);
            $table->boolean('convenio_firmado');
            $table->boolean('entrega_oficio');
            $table->enum('evento', ['Gratuito', 'Pagado']);
            $table->foreignId('categoria')->constrained('categorias')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('post_evento')->constrained('post_eventos')
                ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casa_cultura');
    }
};
