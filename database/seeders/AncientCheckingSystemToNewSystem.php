<?php

namespace Database\Seeders;

use App\Models\BingoGridSquare;
use App\Models\CheckedBy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AncientCheckingSystemToNewSystem extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(BingoGridSquare::all() as $square) {
            $checked_by = $square->checked_by_team_id;

            if($checked_by) {
                CheckedBy::create([
                    'square_id' => $square->id,
                    'team_id' => $checked_by
                ]);
            }
        }
    }
}
