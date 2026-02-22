document.addEventListener('DOMContentLoaded', function() {
    const games_count = parseInt(document.getElementById('games_count').value);
    
    const input_width = document.getElementById('width');
    const input_height = document.getElementById('height');

    let needed_per_game = input_width.value * input_height.value;

    console.log(needed_per_game);
});