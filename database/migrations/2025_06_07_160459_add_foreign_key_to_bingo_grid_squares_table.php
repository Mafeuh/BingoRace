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
        Schema::table('bingo_grid_squares', function (Blueprint $table) {
            $table->foreign('checked_bg_team_id')->references('id')->on('teams')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bingo_grid_squares', function (Blueprint $table) {
            //
        });
    }
};
