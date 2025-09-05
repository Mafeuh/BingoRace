<?php

use App\Models\BingoGrid;
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
        Schema::table('rooms', function (Blueprint $table) {
            $table->foreignId('grid_id')->nullable()->references('id')->on('bingo_grids');
        });

        foreach(BingoGrid::all() as $grid) {
            $room = $grid->room;

            $room->grid_id = $grid->id;
            $room->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            //
        });
    }
};
