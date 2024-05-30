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
        Schema::create('creneaux', function (Blueprint $table) {
            $table->id();
            $table->boolean('statut');
            $table->date('date_c');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->string('type_recurrence')->nullable();;
            $table->integer('debut_recurrence')->nullable();;
            $table->string('fin_recurrence')->nullable();;
            $table->string('jours_recurrence')->nullable();;

            $table->foreignId('salon_coiffures_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creneaux');
    }
};
