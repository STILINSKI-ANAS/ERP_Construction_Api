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
        Schema::create('entrepot', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('Identifiant')->nullable();
            $table->decimal('prix_achat')->nullable();
            $table->decimal('prix_vente')->nullable();
            $table->string('category')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrepot');
    }
};
