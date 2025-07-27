<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Str;

class AppSettingsForm extends Component
{
    public $settings = [];
    public $settings_values = [];
    public string $new_setting_name = "";
    public string $new_setting_value = "";
    public function mount() {
        $this->settings = Setting::all();
        
        foreach($this->settings as $setting) {
            $this->settings_values[$setting->id] = $setting->value;
        }
    }
    public function render()
    {
        return view('livewire.app-settings-form');
    }

    public function new_setting() {
        if(strlen($this->new_setting_name) > 0 && strlen($this->new_setting_value) > 0) {
            Setting::create([
                'key' => Str::slug($this->new_setting_name),
                'description' => $this->new_setting_name,
                'value' => $this->new_setting_value
            ]);
        }
    }

    public function save() {
        foreach($this->settings as $setting) {
            $setting->value = $this->settings_values[$setting->id];
            $setting->save();
        }
        session()->flash('success', 'Modifications enregistrées');
    }
}
