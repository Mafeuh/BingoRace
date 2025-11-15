<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PublicObjective;
use App\Models\PrivateObjective;

class FillCreatorField extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(PublicObjective::all() as $obj) {
            $obj->objective()->creator_id = 1;
        }

        foreach(PrivateObjective::all() as $obj) {
            $obj->objective()->creator_id = $obj->user_id;
        }
    }
}
