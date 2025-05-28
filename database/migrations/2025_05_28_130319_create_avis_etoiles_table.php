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
        Schema::create('avis_etoiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('auteur_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('logement_id')->constrained()->onDelete('cascade');
        $table->tinyInteger('note'); // entre 1 et 5
        $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis_etoiles');
    }
};
