<?php

namespace Database\Seeders;

use App\Models\PatchNote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatchNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PatchNote::factory(100)->create();
    }
}
