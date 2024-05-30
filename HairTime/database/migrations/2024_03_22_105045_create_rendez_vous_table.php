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
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date_rdv')->nullable();
            $table->text('remarque')->nullable();
            
            // Définition des clés étrangères vers clients et compte_coiffeurs
            $table->foreignId('client_users_id')->constrained('clients', 'users_id')->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('salon_coiffures_id')->constrained()->onDelete('cascade');
            $table->foreignId('creneaux_id')->references('id')->on('creneaux')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vous');
    }
};
