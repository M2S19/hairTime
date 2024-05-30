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
        Schema::create('salon_coiffures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('adresse');
            $table->string('ville');
            $table->string('description');
            $table->integer('nombreCoiffeurs')->nullable();

             // Définition des clés étrangères vers clients et compte_coiffeurs
             $table->foreignId('client_users_id')->nullable()->constrained('clients', 'users_id')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salon_coiffures');
    }
};
