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
        Schema::create('logements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proprietaire_id')->constrained('users');
            $table->string('titre');
            $table->string('adresse');
            $table->enum('type', ['studio', 'appartement', 'chambre', 'colocation']);
            $table->integer('nombre_chambres');
            $table->decimal('superficie', 8, 2);
            $table->decimal('loyer', 10, 2);
            $table->decimal('charges', 10, 2)->default(0);
            $table->text('description')->nullable();
            $table->date('disponibilite');
            $table->string('piece_identite_path')->nullable();
            $table->string('titre_propriete_path')->nullable();
            $table->boolean('valide')->default(false);
            $table->foreignId('validateur_id')->nullable()->constrained('users');
            $table->timestamp('valide_le')->nullable();
             $table->enum('etat', ['valide', 'rejeté'])->default('valide'); // Ajouter la colonne etat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logements');
    }
};
