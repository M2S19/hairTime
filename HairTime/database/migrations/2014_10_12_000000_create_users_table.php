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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('role')->nullable();
            $table->string('telephone');
            $table->string('adresse');
            $table->string('ville');
            $table->string('password');
            $table->rememberToken(); // Pour la fonctionnalité "Se souvenir de moi" de l'authentification
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
