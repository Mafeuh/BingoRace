// Initialisation globale
window.gameQuotas = {}; 

document.addEventListener('alpine:init', () => {
    Alpine.data('objectiveManager', (config) => ({
    
        // On initialise avec les variables reçues de Livewire/Blade
        pool: config.pool, 
        max_easy: config.max_easy,
        max_medium: config.max_medium,
        max_hard: config.max_hard,
        nb_easy: config.nb_easy,
        nb_medium: config.nb_medium,
        nb_hard: config.nb_hard,
    
        // Tes variables internes restent normales
        showSelection: false,
        showDifficulty: true,
        gameQuotas: {},
        is_game_valid: {},

        manage_difficulty: config.manage_difficulty,

        difficulty_error: false,
        objectives_error: false,

        can_submit: false,

        checkGamesValidity() {
            this.objectives_error = false;
            Object.entries(this.gameQuotas).forEach((e) => {
                const gameId = e[0];
                const allActiveObjectives = Array.from(document.querySelectorAll('.objective-item'))
                    .filter(item => this.pool[item.dataset.id]);
                const activeForThisGame = allActiveObjectives.filter(item => item.dataset.game == gameId).length;
                const quotaGame = parseInt(this.gameQuotas[gameId]) || 0;
                
                console.log(activeForThisGame, quotaGame);

                let is_valid = activeForThisGame >= quotaGame;

                this.is_game_valid[gameId] = is_valid;

                if(is_valid) this.objectives_error = true;
            });

            console.log(this.is_game_valid);
        },

        checkDifficultyValidity() {
            this.difficulty_error = false;

            if(!this.manage_difficulty) return;

            if(this.nb_easy > this.max_easy) this.difficulty_error = true;
            if(this.nb_medium > this.max_medium) this.difficulty_error = true;
            if(this.nb_hard > this.max_hard) this.difficulty_error = true;
            let target_width = document.getElementById('width').value;
            let target_height = document.getElementById('height').value;
            if(this.nb_easy + this.nb_medium + this.nb_hard != target_height * target_width) this.difficulty_error = true;
        },

        init() {
            this.gameQuotas = window.gameQuotas;
            window.checkGamesValidity = this.checkGamesValidity;
            window.checkDifficultyValidity = this.checkDifficultyValidity;

            this.can_submit = !this.difficulty_error && !this.objectives_error;
        },

        updateQuotas() {
            this.gameQuotas = window.gameQuotas;

            this.checkGamesValidity();
            this.checkDifficultyValidity();
        },

        toggle(el) {
            const id = el.dataset.id;
            const difficulty = el.dataset.difficulty;
        
            const is_disabled = !!this.pool[id];
        
            this.pool = { ...this.pool, [id]: !is_disabled };

            if(difficulty == 1) {
                this.max_easy = this.max_easy + (is_disabled ? 1 : -1);
            }
            if(difficulty == 2) {
                this.max_medium = this.max_medium + (is_disabled ? 1 : -1);
            }
            if(difficulty == 3) {
                this.max_hard = this.max_hard + (is_disabled ? 1 : -1);
            }

            console.log([this.max_easy, this.max_medium, this.max_hard]);

            this.checkGamesValidity();
        },
    }));
});

document.addEventListener('DOMContentLoaded', function() {
    const sample_grid = document.getElementById('sample_grid');
    const input_width = document.getElementById('width');
    const input_height = document.getElementById('height');
    const square_template = document.getElementById('square_template');

    function balance() {
        const sliders = document.querySelectorAll('.game-slider');
        if (!sliders.length) return;

        let w = parseInt(input_width.value) || 3;
        let h = parseInt(input_height.value) || 3;
        let total = w * h;

        document.getElementById('size').textContent = total;

        let sum = 0;
        let repartition = {};
        sliders.forEach(s => {
            let val = parseInt(s.value);
            repartition[s.dataset.gameId] = val;
            sum += val;
        });

        // Calcul des quotas par jeu
        let ratios = Object.entries(repartition).map(([id, val]) => {
            let exact = (val / (sum || 1)) * total;
            return { id, floor: Math.floor(exact), remainder: exact - Math.floor(exact) };
        });

        let allocated = ratios.reduce((a, b) => a + b.floor, 0);
        let toDistribute = total - allocated;
        ratios.sort((a, b) => b.remainder - a.remainder);

        let finalQuotas = {};
        ratios.forEach((item, index) => {
            finalQuotas[item.id] = item.floor + (index < toDistribute ? 1 : 0);
        });

        window.gameQuotas = finalQuotas;
        window.dispatchEvent(new CustomEvent('quotas-updated'));
        fill_grid(finalQuotas, w, h);

        Livewire.dispatch('update-quotas', { quotas: finalQuotas });
    }

    function fill_grid(quotas, w, h) {
        if (!sample_grid) return;
        sample_grid.innerHTML = "";
        sample_grid.style.gridTemplateColumns = `repeat(${w}, minmax(0, 1fr))`;

        let cells = [];
        Object.entries(quotas).forEach(([id, count]) => {
            for(let i=0; i<count; i++) cells.push(id);
        });

        // Shuffle simple
        cells.sort(() => Math.random() - 0.5);

        const gameIds = Object.keys(quotas).sort();
        cells.forEach(gameId => {
            let square = document.importNode(square_template.content, true);
            square.querySelector('.text').innerText = gameIds.indexOf(gameId) + 1;
            sample_grid.appendChild(square);
        });
    }

    input_width.addEventListener('input', balance);
    input_height.addEventListener('input', balance);

    document.addEventListener('change', (e) => {
        if(e.target.classList.contains('game-slider')) balance();
    });



    balance();
});