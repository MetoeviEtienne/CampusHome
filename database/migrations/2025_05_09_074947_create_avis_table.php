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
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auteur_id')->constrained('users');
            $table->foreignId('logement_id')->constrained('logements');
            $table->foreignId('reservation_id')->constrained('reservations');
            $table->integer('note'); // 1-5
            $table->text('commentaire');
            $table->boolean('verifie')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
