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
        Schema::create('bingo_grids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->references('id')->on('rooms')->constrained()->cascadeOnDelete();
            $table->integer('width')->unsigned();
            $table->integer('height')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bingo_grids');
    }
};
