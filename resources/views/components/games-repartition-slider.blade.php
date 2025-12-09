@props(['pool_size', 'width', 'height', 'room'])

<div class="select-none">
    <div class="h-12 flex relative" id="slide_container" data-max="{{ $width * $height }}">
        @for($i = 1; $i < (sizeof($room->games)); $i++)
            <div @class([
                'from-red-400 to-blue-400 dark:from-red-900 dark:to-blue-900' => $i % 2 == 1,
                'from-blue-400 to-red-400 dark:from-blue-900 dark:to-red-900' => $i % 2 == 0,
                'absolute h-12 w-4 bg-gradient-to-r -ml-2 cursor-col-resize slider border border-white/50'
            ]) 
                id="slider{{$i}}" onmousedown="slide('slider{{$i}}')"
                data-slider_number="{{ $i }}" style="left: {{ $i * 100 / sizeof($room->games)}}%;"></div>
        @endfor
        @foreach ($room->games as $game)
            <div @class([
                'h-full text-center game text-sm flex flex-col items-center justify-center', 
                'bg-red-400 dark:bg-red-900' => $loop->odd, 
                'bg-blue-400 dark:bg-blue-900' => $loop->even, 
                'rounded-l-lg' => $loop->first, 
                'rounded-r-lg' => $loop->last]) 
                style="width: {{ 100/sizeof($room->games) }}%;" id="game{{$loop->index}}"
                data-game_id="{{$game->id}}">
                <div>{{ $game->name }}</div>
                <div>
                    <span class="part">
                        {{ round(1/sizeof($room->games) * $width * $height) }}
                    </span>
                    <span class="text-xs text-gray-500">
                        (<span class="percent">{{ 100/sizeof($room->games) }}</span>%)
                    </span>
                </div>
            </div>
            <input type="number" class="hidden" wire:model="games_objectives_count.{{$game->id}}" id="game_obj_{{$loop->index}}">
        @endforeach
    </div>

    <script>
        let held_slider = null;
        let container = document.getElementById('slide_container');

        let games = document.getElementsByClassName('game');

        let percentage = Object.fromEntries(Array.from(games).map(e => [e.id, 100 / games.length]));
        let values = [];

        let limit_left = 0;
        let limit_right = 0;

        function slide(id) {
            held_slider = document.getElementById(id);

            let left_slider = document.getElementById(`slider${parseInt(held_slider.dataset.slider_number) - 1}`);
            let right_slider = document.getElementById(`slider${parseInt(held_slider.dataset.slider_number) + 1}`);

            limit_left = left_slider ? parseFloat(left_slider.style.left) : 0;
            limit_right = right_slider ? parseFloat(right_slider.style.left) : 100;
        }

        function distribute() {
            let max = document.getElementById('slide_container').dataset.max;

            let keys = Object.values(percentage);

            // Étape 1 : valeurs brutes
            let raw = keys.map(p => (p / 100) * max);

            // Étape 2 : partie entière de chaque valeur
            values = raw.map(v => Math.floor(v));

            // Étape 3 : combien reste-t-il à attribuer ?
            let diff = max - values.reduce((a, b) => a + b, 0);

            // Étape 4 : distribuer les restes aux plus grosses décimales
            let remainders = raw.map((v, i) => ({ idx: i, frac: v - values[i] }));
            remainders.sort((a, b) => b.frac - a.frac);

            for (let i = 0; i < diff; i++) {
                values[remainders[i].idx]++;
            }

            for(let i = 0; i < Object.keys(percentage).length; i++) {
                let key = Object.keys(percentage)[i];
                let value = values[i];
                let perc = percentage[key];

                document.getElementById(key).style.width = `${perc}%`;
                document.getElementById(key).getElementsByClassName('part')[0].innerText = value;
                document.getElementById(key).getElementsByClassName('percent')[0].innerText = Math.round(perc * 100) / 100;
                
                
                let element = document.getElementById(`game_obj_${i}`);
                element.value = value;
                element.dispatchEvent(new Event('input', { bubbles: true }));
            }
        }

        function setValues() {
            for(let i = 0; i < Object.keys(percentage).length; i++) {
                let key = Object.keys(percentage)[i];
                let value = values[i];
                let element = document.getElementById(`game_obj_${i}`);
                
                // Mettre à jour la valeur
                element.value = value;
                
                // Déclencher l'événement input pour que Livewire détecte le changement
                element.dispatchEvent(new Event('input', { bubbles: true }));
            }
        }
        
        document.addEventListener('mouseup', function() {
            if(held_slider) {
                setValues();
            }
            held_slider = null;
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            distribute();
            setValues();

            setTimeout(() => {
                setValues();
            }, 0);
        });

        document.addEventListener('trigger-distribute', () => {
            setTimeout(() => {
                distribute();
            }, 0);
        });

        document.addEventListener('mousemove', function(event) {
            if(held_slider) {
                let slider_number = held_slider.dataset.slider_number;

                let new_pos = (event.clientX - container.getBoundingClientRect().x) / container.getBoundingClientRect().width * 100;
                new_pos = Math.min(Math.max(new_pos, limit_left), limit_right);

                let left_div_key = `game${parseInt(slider_number) - 1}`;
                let right_div_key = `game${parseInt(slider_number)}`;

                percentage[left_div_key] = `${new_pos - limit_left}`;
                percentage[right_div_key] = `${limit_right - new_pos}`;

                held_slider.style.left = new_pos + "%";

                distribute();
            }
        });
    </script>
</div>