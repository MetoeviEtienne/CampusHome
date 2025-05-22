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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations');
            $table->decimal('montant', 10, 2);
            $table->enum('type', ['avance', 'mensuel'])->default('mensuel')->after('montant');
            $table->decimal('taxe', 10, 2)->default(0); // 15% de taxe
            $table->string('methode'); // Mobile Money, carte bancaire, etc.
            $table->string('reference');
            $table->string('quittance')->nullable(); // Chemin vers la quittance
            $table->enum('statut', ['en_attente', 'payé', 'echec', 'remboursé']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
