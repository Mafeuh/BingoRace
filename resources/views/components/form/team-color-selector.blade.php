<div>
    <input type="hidden" name="selected_color" id="selected" wire:model="selected_color">
    
    <div class="bg-white/40 dark:bg-slate-900/30 flex overflow-x-scroll p-2 scrollbar-hidden scroll-smooth transition-all duration-100" id="color-scroll">
        @foreach ($colors as $name => $color)
            <div id="{{ $color }}" onclick="select_color('{{ $color }}')" style="background-color: {{ $color }}" @class([
                'relative size-24 flex-shrink-0 scrollbar-hidden ',
                'rounded-l-lg' => $loop->first, 
                'rounded-r-lg' => $loop->last, 
            ])>
                <span class="absolute inset-0 flex items-center justify-center">
                    <span class="bg-white/50 p-1 rounded text-black/50 font-bold">
                        {{ __('colors.'.$name) }}
                    </span>
                </span>
            </div>    
        @endforeach
    </div>

    <script>
        let previousSelected = "";
        const input = document.getElementById('selected');
        
        function select_color(color) {
            input.value = color;
            input.dispatchEvent(new Event('input'));
            
            if(previousSelected != "") {
                document.getElementById(previousSelected).classList.remove('border-4');
                document.getElementById(previousSelected).classList.remove('border-black/50');
            }
            document.getElementById(color).classList += ' border-4 border-black/50';
            previousSelected = color;
        }

        // Script pour le scroll
        const scrollContainer = document.getElementById('color-scroll');

        scrollContainer.addEventListener('wheel', function (e) {
            // Si on essaie de scroller verticalement
            if (e.deltaY !== 0) {
                e.preventDefault(); // empêche le scroll vertical
                scrollContainer.scrollLeft += e.deltaY * 2; // applique le scroll horizontal
            }
        }, { passive: false });
    </script>
</div>