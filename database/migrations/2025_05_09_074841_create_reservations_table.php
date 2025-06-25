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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logement_id')->constrained('logements');
            $table->foreignId('etudiant_id')->constrained('users');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('visite_date')->nullable(); // 👈 Nouvelle colonne
            $table->time('visite_heure')->nullable(); // 👈 Nouvelle colonne
            $table->boolean('visite_confirmee')->default(false);
            $table->boolean('visite_rejetee')->default(false);
            $table->string('universite'); // 👈 Université de l’étudiant
            $table->text('inscription_pdf'); // 👈 Chemin du PDF d’inscription_
            $table->enum('statut', ['en_attente', 'approuvée', 'rejetée', 'annulée']);
            $table->text('contrat')->nullable(); // Chemin vers le contrat généré
            $table->boolean('contrat_signe')->default(false);
            // $table->unique(['logement_id', 'etudiant_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
