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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('stock_id')->constrained();
//            $table->foreignId('fournisseur_id')->constrained();

            $table->unsignedBigInteger('entrepot_id');
            $table->unsignedBigInteger('fournisseur_id');

            $table->foreign('entrepot_id')->references('id')->on('entrepot')->onDelete('restrict');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('restrict');




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
