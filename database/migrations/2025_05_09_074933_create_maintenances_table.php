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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logement_id')->constrained('logements');
            $table->foreignId('etudiant_id')->constrained('users');
            $table->text('description');
            $table->enum('urgence', ['faible', 'moyenne', 'haute']);
            $table->enum('statut', ['nouveau', 'en_cours', 'resolu']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
