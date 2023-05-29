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
        Schema::create('projet_workers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projet_id');
            $table->unsignedBigInteger('worker_id');
            $table->decimal('hours')->nullable();
            $table->decimal('somme')->nullable();
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('restrict');
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projet_workers');
    }
};
