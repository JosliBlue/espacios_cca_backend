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
        Schema::create('space_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('responsible_person');
            $table->char('responsible_person_phone', 10);
            $table->boolean('contract_reception_signed');
            //REMOVIDO
            //$table->boolean('reserved');
            $table->enum('status', ['Aprobado', 'Rechazado', 'Pendiente']);
            $table->boolean('agreement_signed');
            $table->boolean('delivery_document');
            $table->enum('event_type', ['Gratuito', 'Pagado']);
            $table->foreignId('location_id')->constrained('locations')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('post_event_id')->constrained('post_events')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_reservations');
    }
};
