<?php

namespace App\Livewire;

use App\Models\Room;
use Carbon\Carbon;
use Livewire\Component;

class RoomTimer extends Component
{
    public ?Room $room;
    public string $back_color = "bg-red-300";
    public string $border_color = "border-red-500";
    public string $text_color = "text-black";
    public int $remaining_time_in_seconds;

    public string $displayed_time = "";

    public function mount(Room $room) {
        $this->room = $room;
        $this->remaining_time_in_seconds = Carbon::parse($room->started_at)->addSeconds((int)$room->duration_seconds + 10)->timestamp - now()->timestamp;
    }

    public function render()
    {
        return view('livewire.room-timer');
    }

    public function tick() {
        if($this->remaining_time_in_seconds >= 0) {
            $this->set_displayed_time();
        }
        if($this->remaining_time_in_seconds <= 0) {
            $this->dispatch('timer_ended');
        }
        $this->remaining_time_in_seconds -= 1;
        $this->update_style();
    }

    private function update_style() {
        // More than 10 minutes left
        if($this->remaining_time_in_seconds >= 60 * 10) {
            $this->back_color = "bg-green-300";
            $this->border_color = "border-green-500";
            $this->text_color = "text-black";
        } elseif($this->remaining_time_in_seconds >= 60 * 5) {
            $this->back_color = "bg-yellow-300";
            $this->border_color = "border-yellow-500";
            $this->text_color = "text-black";
        } elseif($this->remaining_time_in_seconds >= 60) {
            $this->back_color = "bg-orange-300";
            $this->border_color = "border-orange-500";
            $this->text_color = "text-black";
        } else {
            $this->back_color = "bg-red-300";
            $this->border_color = "border-red-500";
            $this->text_color = "text-red-900 font-bold";
        }
    }

    private function set_displayed_time() {
        if ($this->remaining_time_in_seconds >= 3600) {
            $hours = str_pad((string)floor($this->remaining_time_in_seconds / 3600), 2, '0', STR_PAD_LEFT);
            $minutes = str_pad((string)floor(($this->remaining_time_in_seconds % 3600) / 60), 2, '0', STR_PAD_LEFT);
            $seconds = str_pad((string)floor(($this->remaining_time_in_seconds % 60)), 2, '0', STR_PAD_LEFT);
            $this->displayed_time = "$hours:$minutes.$seconds";
        } else {
            $minutes = str_pad((string)floor($this->remaining_time_in_seconds / 60), 2, '0', STR_PAD_LEFT);
            $seconds = str_pad((string)($this->remaining_time_in_seconds % 60), 2, '0', STR_PAD_LEFT);
    
            $this->displayed_time = "$minutes:$seconds";
        }
    }
    
}
