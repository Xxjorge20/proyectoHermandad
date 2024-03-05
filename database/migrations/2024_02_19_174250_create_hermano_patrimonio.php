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
        Schema::create('hermano_patrimonio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hermano_id');
            $table->unsignedBigInteger('patrimonio_id');
            $table->string('asignado_por')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hermano_patrimonio');
    }
};
