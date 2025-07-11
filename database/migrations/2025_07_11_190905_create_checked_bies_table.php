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
        Schema::create('checked_bies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('square_id')->references('id')->on('bingo_grid_squares');
            $table->foreignId('team_id')->references('id')->on('teams');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checked_bies');
    }
};
