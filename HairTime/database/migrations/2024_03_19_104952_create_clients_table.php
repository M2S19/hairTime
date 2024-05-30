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
        Schema::create('clients', function (Blueprint $table) {
            $table->foreignId('users_id')->primary()->constrained('users')->onDelete('cascade'); // Définit 'users_id' comme clé primaire et clé étrangère
            // Ajoutez ici les colonnes spécifiques à 'clients'
            $table->string('preferences')->nullable(); // Exemple d'attribut spécifique à 'clients'
            $table->timestamps();
        

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
