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
        Schema::table('checked_bies', function (Blueprint $table) {
            $table->foreignId('participant_id')->nullable()->references('id')->on('participants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checked_bies', function (Blueprint $table) {
            //
        });
    }
};
