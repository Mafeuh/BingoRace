<div class="grid grid-cols-3 space-x-4">
    <div class="bg-green-50 p-4">
        <h2 class="text-xl">Grille</h2>
        <div class="grid grid-cols-2 text-left">
            <label for="grid_width">Largeur</label>
            <input type="number" min="1" max="10" value="5" disabled name="grid_width" id="grid_width">

            <label for="grid_height">Hauteur</label>
            <input type="number" min="1" max="10" value="5" disabled name="grid_height" id="grid_height">
        </div>
    </div>

    <div class="bg-green-50 p-4">
        <h2 class="text-xl">Objectifs</h2>
        <div class="grid grid-cols-3 text-left">
            <label for="public_objectives" class="col-span-2">Objectifs publics ?</label>
            <input type="checkbox" name="objective_type" id="public_objectives" value="public">

            <label for="public_objectives" class="col-span-2">Objectifs privés ?</label>
            <input type="checkbox" name="objective_type" id="private_objectives" value="private">
        </div>
    </div>
</div>
