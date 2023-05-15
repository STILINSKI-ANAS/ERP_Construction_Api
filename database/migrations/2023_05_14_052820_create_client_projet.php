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
        Schema::create('client_projet', function (Blueprint $table) {
            $table->id();
            $table->string('objet')->nullable();
            $table->decimal('somme')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('client_id')->constrained()->restrictOnDelete();
            $table->foreignId('projet_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_projet');
    }
};
