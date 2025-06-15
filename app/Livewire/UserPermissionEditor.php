<?php

namespace App\Livewire;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Livewire\Component;

class UserPermissionEditor extends Component
{
    public $render_id;
    public $permissions_states = [];
    public ?User $selected_user = null;
    public $search_result = [];
    public string $name = '';
    public $permissions; // Liste des permissions chargées une fois

    public function mount()
    {
        $this->render_id = uniqid();

        $this->permissions = Permission::all();

        // Initialiser toutes les permissions à false
        $this->permissions_states = $this->permissions
            ->pluck('id')
            ->mapWithKeys(fn ($id) => [$id => false])
            ->toArray();
    }

    public function updatedName()
    {
        $this->search_result = User::where('name', 'LIKE', '%' . $this->name . '%')->get();
    }

    public function load_user(int $user_id)
    {
        $this->selected_user = User::find($user_id);

        // Reset des permissions
        $this->permissions_states = $this->permissions
            ->pluck('id')
            ->mapWithKeys(fn ($id) => [$id => false])
            ->toArray();

        // Marquer les permissions actuelles de l'utilisateur comme "true"
        foreach ($this->selected_user->permissions as $permission) {
            $this->permissions_states[$permission->permission_id] = true;
        }

        $this->render_id = uniqid();
    }

    public function set_user_permissions()
    {
        if (!$this->selected_user) {
            session()->flash('error', 'Aucun utilisateur sélectionné.');
            return;
        }

        // Filtrer les permissions cochées
        $permission_ids = collect($this->permissions_states)
            ->filter()
            ->keys()
            ->toArray();
                
        $this->selected_user->permissions()->delete();

        foreach($permission_ids as $id) {
            UserPermission::create([
                'user_id' => $this->selected_user->id,
                'permission_id' => $id
            ]);
        }

        session()->flash('success', 'Permissions mises à jour.');

    }

    public function render()
    {
        return view('livewire.user-permission-editor');
    }
}
