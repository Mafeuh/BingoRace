<div class="grid grid-cols-2 space-x-4">
    <div class="bg-green-50 p-4">
        <h2 class="text-xl">Grille</h2>
        <div class="grid sm:grid-cols-2">
            <div>
                <x-form.label for="grid_width">Largeur de la grille</x-form.label>
                <x-form.number-input name="grid_width" min="1" max="10" value="5"/>
            </div>

            <div>
                <x-form.label for="grid_height">Hauteur de la grille</x-form.label>
                <x-form.number-input name="grid_height" min="1" max="10" value="5"/>
            </div>
        </div>
    </div>

    <div class="bg-green-50 p-4">
        <h2 class="text-xl">Objectifs</h2>
        <div class="grid grid-cols-3 text-left">
            <label for="public_objectives" class="col-span-2">Objectifs publics&nbsp;?</label>
            <input type="checkbox" name="objective_type[]" id="public_objectives" value="public" checked>

            <label for="private_objectives" class="col-span-2">Objectifs privés&nbsp;?</label>
            <input type="checkbox" name="objective_type[]" id="private_objectives" value="private" checked>
        </div>
    </div>
</div>
