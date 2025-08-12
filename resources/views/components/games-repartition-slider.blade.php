@props(['pool_size', 'width', 'height', 'room'])

<div class="select-none">
    <div class="h-16 flex relative bg-gray-300" id="slide_container" data-max="{{ $width * $height }}">
        @for($i = 1; $i < (sizeof($room->games)); $i++)
            <div 
                class="absolute h-16 w-4 bg-red-500 -ml-2 opacity-50 cursor-col-resize slider" 
                id="slider{{$i}}" onmousedown="slide('slider{{$i}}')"
                data-slider_number="{{ $i }}" style="left: {{ $i * 100 / sizeof($room->games)}}%;"></div>
        @endfor
        @foreach ($room->games as $game)
            <div @class(['h-full text-center game', 'bg-gray-200' => $loop->odd, 'bg-gray-100' => $loop->even]) 
                style="width: {{ 100/sizeof($room->games) }}%;" id="game{{$loop->index}}"
                data-game_id="{{$game->id}}">
                <div>{{ $game->name }}</div>
                <div class="percent">
                    {{ round(1/sizeof($room->games) * $width * $height) }}
                </div>
            </div>
        @endforeach
    </div>

    <script>
        let held_slider = null;
        let container = document.getElementById('slide_container');

        let games = document.getElementsByClassName('game');

        let percentage = Object.fromEntries(Array.from(games).map(e => [e.id, 100 / games.length]));

        let limit_left = 0;
        let limit_right = 0;
        
        function updateCount(is_disabled) {
            count += is_disabled ? -.5 : .5;
        }

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
            let result = raw.map(v => Math.floor(v));

            // Étape 3 : combien reste-t-il à attribuer ?
            let diff = max - result.reduce((a, b) => a + b, 0);

            // Étape 4 : distribuer les restes aux plus grosses décimales
            let remainders = raw.map((v, i) => ({ idx: i, frac: v - result[i] }));
            remainders.sort((a, b) => b.frac - a.frac);

            for (let i = 0; i < diff; i++) {
                result[remainders[i].idx]++;
            }

            for(let i = 0; i < Object.keys(percentage).length; i++) {
                let key = Object.keys(percentage)[i];
                let value = result[i];

                document.getElementById(key).getElementsByClassName('percent')[0].innerText = value;
            }
        }
        
        document.addEventListener('mouseup', function() {
            held_slider = null;
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            distribute();
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