document.addEventListener('DOMContentLoaded', function() {
    const sample_grid = document.getElementById('sample_grid');

    const input_width = document.getElementById('width');
    const input_height = document.getElementById('height');
    const input_sliders = document.querySelectorAll('input[type=range]');
    
    const square_template = document.getElementById('square_template');

    let values_array = [];

    
    let games_indexes;
    
    function balance() {
        let repartition = {};
        
        let w = parseInt(input_width.value) || 3;
        let h = parseInt(input_height.value) || 3;
        let total_cells = input_height.value * input_width.value;

        let sum = 0;

        for(let i = 0; i < input_sliders.length; i++) {
            let game_id = input_sliders[i].id;
            let val = parseInt(input_sliders[i].value);
            repartition[game_id] = val;
            sum += val;
        }

        let ratios = Object.entries(repartition).map(([key, percent]) => {
            let exact = (percent / sum) * total_cells;
            return {
                key: key,
                floor: Math.floor(exact),
                remainder: exact - Math.floor(exact)
            };
        });

        let allocated = ratios.reduce((sum, item) => sum + item.floor, 0);
        let to_distribute = total_cells - allocated;

        let sortedByRemainder = [...ratios].sort((a, b) => b.remainder - a.remainder);

        sortedByRemainder.forEach(item => {
            if (to_distribute > 0) {
                item.finalCount = item.floor + 1;
                to_distribute--;
            } else {
                item.finalCount = item.floor;
            }
        });

        let number_of_objectives_per_game = {};
        ratios.forEach(item => {
            number_of_objectives_per_game[item.key] = item.finalCount;
        });

        // Pour ton fill_grid, tu peux maintenant transformer cet objet en tableau plat :
        values_array = Object.entries(number_of_objectives_per_game).flatMap(([key, count]) => 
            Array(count).fill(key)
        );

        games_indexes = [...new Set(values_array)].sort();

        fill_grid();
    }
    
    function fill_grid() {
        // 2. Vérification si le tableau est vide
        if (values_array.length === 0) {
            console.warn("Attention : values_array est vide. La grille ne sera pas remplie.");
            // Optionnel : ne pas vider la grille si on n'a rien pour la remplir
            // return; 
        }

        sample_grid.innerHTML = "";

        const shuffle = (array) => {
            for (let i = array.length - 1; i > 0; i--) {
              // Choisir un index aléatoire entre 0 et i
              const j = Math.floor(Math.random() * (i + 1));
              
              // Échanger les éléments array[i] et array[j]
              [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        };

        values_array = shuffle(values_array);

        let w = input_width.value || 3;
        let h = input_height.value || 3;
        let total = w * h;
        sample_grid.style.gridTemplateColumns = `repeat(${w}, minmax(0, 1fr))`;

        for(let i = 0; i < total; i++) {
            if (!values_array[i]) break;

            let square = document.importNode(square_template.content, true);
            square.querySelector('.text').innerText = games_indexes.indexOf(values_array[i]) + 1;
            sample_grid.appendChild(square);
        }
    }
    
    if(sample_grid) {
        input_width.addEventListener('input', balance);
        input_height.addEventListener('input', balance);

        input_sliders.forEach((e) => {
            e.addEventListener('change', balance);
        });
    }
    
    balance();
});