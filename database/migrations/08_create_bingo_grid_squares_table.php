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
        Schema::create('bingo_grid_squares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grid_id')->references('id')->on('bingo_grids')->cascadeOnDelete();
            $table->foreignId('objective_id')->references('id')->on('objectives')->cascadeOnDelete();
            $table->dateTime('checked_at')->nullable();
            $table->foreignId('checked_by_team_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bingo_grid_squares');
    }
};
