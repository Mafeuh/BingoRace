<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Objective;
use App\Models\PublicObjective;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MinecraftObjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $minecraft = Game::find(1);

        $objectifs = [
            'Trouver un diamant',
            'Trouver une structure sauf village',
            'Aller dans le nether',
            'Mourir',
            'Avoir 1 stack d\'escaliers en cobble',
            'Manger une pomme normale',
            'Manger une pomme dorée pas enchant',
            'Tuer un creeper (sans l\'exploser)',
            'Trouver désert / mesa / savane',
            'Atteindre la bedrock',
            'Casser de l\'obsidienne',
            'Craft 1 bloc d\'or',
            'Faire un MLG avec succès',
            'Ecrire "TEUB" sur un panneau',
            'Faire se reproduire deux animaux',
            'Trouver une jungle',
            'Survivre à un lit dans le nether',
            'Avoir une boussole et une montre',
            'Dompter un cheval',
            'Voler un forgeron (village)',
            'Faire une Herobrine Shrine',
            'Manger 3 viandes cuites différentes',
            'Trouver de la glace',
            'Trouver un trésor enterré',
            'Faire un bonhomme de neige',
            'Faire un Aether portal (avec l\'eau)',
            'Glisser sur de la glace avec un bateau',
            'Atteindre la hauteur maximale',
            'Aller sur une île flottante',
            'Avoir une full armure en fer',
            'Avoir une pioche en diamant',
            'Faire exploser un creeper au briquet',
            'Tuer un squelette avec un arc',
            'Obtenir un disque',
            'Soigner un villageois',
            'Faire un générateur à cobble de 0',
            'Pêcher autre chose qu\'un poisson',
            'Boire une potion',
            'Adopter un chien',
            'Adopter un perroquet',
            'Chevaucher un cochon',
            'Trade avec un villageois',
            'Enchanter un objet',
            'Chevaucher un Strider',
        ];
        
        foreach($objectifs as $obj) {
            $pub = PublicObjective::create([]);
            $pub->objective()->create([
                'game_id' => $minecraft->id,
                'description' => $obj
            ]);
        }
    }
}
