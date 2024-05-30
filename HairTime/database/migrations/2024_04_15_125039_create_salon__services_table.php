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
        Schema::create('salon_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('genre')->nullable();
            $table->string('description')->nullable();
            $table->string('duree');
            $table->float('prix', 8, 2);
            $table->timestamps();
            
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('salon_coiffures_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salon__services');
    }
};
