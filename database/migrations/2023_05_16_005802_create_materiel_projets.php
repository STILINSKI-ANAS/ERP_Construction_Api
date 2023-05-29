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
        Schema::create('materiel_projets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materiel_id');
            $table->unsignedBigInteger('projet_id');
            $table->decimal('hours')->nullable();
            $table->decimal('somme')->nullable();
            $table->foreign('materiel_id')->references('id')->on('materiels')->onDelete('restrict');
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiel_projets');
    }
};
