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
        Schema::create('culto_hermano', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('culto_id');
            $table->unsignedBigInteger('hermano_id');
            $table->string('asignado_por')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culto_hermano');
    }
};
