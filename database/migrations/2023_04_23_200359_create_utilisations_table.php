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
        Schema::create('utilisations', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_num')->nullable();
            $table->unsignedBigInteger('entrepot_id');
            $table->unsignedBigInteger('projet_id');

            $table->foreign('entrepot_id')->references('id')->on('entrepot')->onDelete('');
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisations');
    }
};
