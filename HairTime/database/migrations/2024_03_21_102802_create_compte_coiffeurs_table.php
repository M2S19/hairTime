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
        Schema::create('compte_coiffeurs', function (Blueprint $table) {
            // Supprimez la ligne qui crée un 'id' auto-incrémenté
            $table->foreignId('users_id')->primary()->constrained('users')->onDelete('cascade'); // Définit 'users_id' comme clé primaire et clé étrangère
            $table->string('specialite')->nullable(); // Exemple d'attribut spécifique à 'compte_coiffeurs'

            $table->foreignId('salon_id')->nullable()->references('id')->on('salon_coiffures')->constrained()->onDelete('set null');
                    
            $table->timestamps();
            

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compte_coiffeurs');
    }
};
