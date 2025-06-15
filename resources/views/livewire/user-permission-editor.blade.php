<div>
    <div class="text-center mb-4">
        <input type="text" placeholder="Nom de l'utilisateur"
               wire:model.live.debounce.500ms="name"
               class="border border-gray-300 rounded-full text-center py-2 px-4 w-1/2"/>
    </div>

    @if (sizeof($search_result) > 0)
        <div class="border shadow mb-6">
            <div class="font-bold grid grid-cols-3 bg-gray-100 px-4 py-2">
                <div>Pseudo</div>
                <div>Email</div>
                <div>Rejoint le</div>
            </div>
            @foreach ($search_result as $res)
                <div wire:key="user-result-{{ $res->id }}"
                     wire:click="load_user({{ $res->id }})"
                     class="grid grid-cols-3 px-4 py-2 hover:bg-gray-50 cursor-pointer">
                    <div>{{ $res->name }}</div>
                    <div>{{ $res->email }}</div>
                    <div>{{ $res->created_at->format('d/m/Y') }}</div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($selected_user)
        <div class="font-bold text-lg text-center mb-4">
            Utilisateur choisi : {{ $selected_user->name }}
        </div>

        <div class="border-2 rounded-2xl shadow divide-y-2 p-4 space-y-2">
            @foreach ($permissions as $permission)
                <label wire:key="perm-{{ $permission->id }}"
                       class="grid grid-cols-2 items-center py-2">
                    <div class="text-right pr-4">
                        {{ $permission->description }}
                    </div>
                    <div class="text-center">
                        <input type="checkbox"
                                wire:key="perm-{{ $render_id }}-{{ $permission->id }}"
                                wire:model="permissions_states.{{ $permission->id }}"
                                class="w-5 h-5" />
                    </div>
                </label>
            @endforeach
        </div>

        <div class="mt-5 text-center">
            <button wire:click="set_user_permissions"
                    class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">
                Valider les permissions
            </button>
        </div>

        @if (session()->has('success'))
            <div class="text-green-600 text-center mt-2">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="text-red-600 text-center mt-2">
                {{ session('error') }}
            </div>
        @endif
    @endif
</div>
