<div class="space-y-6">
    <div class="border dark:border-slate-800 shadow bg-white dark:bg-slate-600">
        <div class="font-bold grid grid-cols-2 bg-gray-200 dark:bg-slate-800 px-4 py-2">
            <div>Nom</div>
            <div>Valeur</div>
        </div>
        <div>
            @foreach ($settings as $setting)
            <div wire:key="user-result-{{ $setting->id }}"
                class="grid grid-cols-2 px-4 py-2">
                <div class="p-1">{{ $setting->description }}</div>
                
                <x-form.text-input wire:model="settings_values.{{ $setting->id }}"/>
            </div>
            @endforeach
            <div class="text-center p-2">
                <x-form.button wire:click="save()">Confirmer</x-form.button>
                @if (session('success'))
                    <div class="text-center text-green-500">{{ session('success') }}</div>
                @endif
            </div>
        </div>
    </div>

    <div class="border dark:border-slate-800 shadow bg-white dark:bg-slate-600">
        <h2 class="text-center text-lg font-bold bg-gray-200 dark:bg-slate-800 px-4 py-2">Nouveau paramètre</h2>
        <div class="grid grid-cols-4 gap-2 p-2">
            <x-form.text-input class="col-span-2" placeholder="Nom"
                wire:model="new_setting_name"></x-form.text-input>

            <x-form.text-input class="col-span-2" placeholder="Valeur"
                wire:model="new_setting_value"></x-form.text-input>
        </div>
        <div class="text-center p-2">
            <x-form.button wire:click="new_setting()">
                Confirmer
            </x-form.button>
        </div>
    </div>
</div>
