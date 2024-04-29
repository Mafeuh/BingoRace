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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5)->unique()->nullable();
            $table->foreignId('creator_id')->references('id')->on('users');
            $table->boolean('has_public_objectives')->default(false);
            $table->boolean('has_private_objectives')->default(false);
            $table->boolean('has_team_objectives')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
