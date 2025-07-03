<?php

namespace App\Livewire;

use App\Models\FavoriteGame;
use App\Models\Game;
use Livewire\Component;

class FavoriteCheck extends Component
{
    public int $game_id;
    public Game $game;
    public bool $is_favorite;
    public function mount() {
        $this->game = Game::find($this->game_id);
        $this->is_favorite = auth()->user()->hasFavorite($this->game);
    }
    public function render()
    {
        return view('livewire.favorite-check');
    }

    public function switch_favorite_state() {
        if($this->is_favorite) {
            FavoriteGame::where('game_id', $this->game_id)->where('user_id', auth()->user()->id)->delete();
        } else {
            FavoriteGame::create([
                'game_id' => $this->game_id,
                'user_id' => auth()->user()->id
            ]);
        }
        $this->is_favorite = !$this->is_favorite;
    }
}
