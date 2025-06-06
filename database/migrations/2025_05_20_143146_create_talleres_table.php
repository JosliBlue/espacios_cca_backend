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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('monthly_cost');
            $table->string('age_range');
            $table->string('class_days')->comment('Monday, Tuesday, etc');
            $table->string('morning_schedule')->nullable();
            $table->string('afternoon_schedule')->nullable();
            $table->foreignId('instructor_id')->constrained('instructors')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('location_id')->constrained('locations')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
