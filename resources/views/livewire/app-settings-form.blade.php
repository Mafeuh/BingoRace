<div class="space-y-6">
    <div class="border shadow bg-white">
        <div class="font-bold grid grid-cols-2 bg-gray-200 px-4 py-2">
            <div>Nom</div>
            <div>Valeur</div>
        </div>
        <div>
            @foreach ($settings as $setting)
            <div wire:key="user-result-{{ $setting->id }}"
                class="grid grid-cols-2 px-4 py-2 bg-white">
                <div class="p-1">{{ $setting->description }}</div>
                <input 
                type="text" 
                class="p-1 border-gray-200 focus:border-gray-500"
                wire:model="settings_values.{{ $setting->id }}"
                />
            </div>
            @endforeach
            <div class="text-center p-2">
                <button class="px-2 py-1 bg-green-300 hover:bg-green-400 text-lg rounded-full" wire:click="save()">
                    Confirmer
                </button>
                @if (session('success'))
                    <div class="text-center text-green-500">{{ session('success') }}</div>
                @endif
            </div>
        </div>
    </div>

    <div class="border shadow bg-white">
        <h2 class="text-center text-lg font-bold bg-gray-200">Nouveau paramètre</h2>
        <div class="grid grid-cols-4 gap-2 p-2">
            <input 
                type="text" 
                class="p-1 col-span-2 border-gray-300 rounded" 
                placeholder="Nom"
                wire:model="new_setting_name">
            <input 
                type="text"
                class="p-1 col-span-2 border-gray-300 rounded" 
                placeholder="Valeur"
                wire:model="new_setting_value">
        </div>
        <div class="text-center p-2">
            <button class="px-2 py-1 bg-green-300 hover:bg-green-400 text-lg rounded-full" wire:click="new_setting()">
                Confirmer
            </button>
        </div>
    </div>
</div>
