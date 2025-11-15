@props(['room', 'ends_at'])

<div id="timer" class="">
    <p class="text-center"><span id="hours"></span>:<span id="minutes"></span>:<span id="seconds"></span></p>
    <p class="text-xs text-center">Fin à <span id="ends_at"></span></p>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ends_at_unix_s = {{ $ends_at }};

        let remaining = null;
        const timerEndedEvent = new Event('timer_ended');

        function updateTimer() {
            remaining = Math.floor(ends_at_unix_s - (new Date().getTime() / 1000));

            console.log(remaining);
    
            let minutes = Math.floor(remaining / 60);
            let hours = Math.floor(minutes / 60);
            let seconds = remaining % 60;
    
            document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
            document.getElementById('minutes').innerText = (minutes % 60).toString().padStart(2, '0');
            document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
            document.getElementById('ends_at').innerText = new Date({{ $ends_at }} * 1000).toLocaleString(navigator.language || 'fr-FR', {hour: '2-digit', minute: '2-digit'});

            document.title = "Bingorace ! " + hours.toString().padStart(2, '0') + ":" + (minutes % 60).toString().padStart(2, '0') + ":" + seconds.toString().padStart(2, '0');

            if(remaining <= 0) {
                dispatchEvent(timerEndedEvent);
                clearInterval(intervalId);
            }

            updateStyle();
        }

        function updateStyle() {
            let timer = document.getElementById('timer');
            const base_classes = ["border-4", "w-fit", "p-2", "text-xl", "rounded-full", "font-mono"];

            timer.classList = [];

            if(remaining >= 60 * 30) {
                timer.classList.add(...base_classes, 'bg-green-300', 'border-green-500');
            } else if(remaining >= 60 * 10) {
                timer.classList.add(...base_classes, 'bg-yellow-300', 'border-yellow-500');
            } else if(remaining >= 60 * 5) {
                timer.classList.add(...base_classes, 'bg-orange-300', 'border-orange-500');
            } else {
                timer.classList.add(...base_classes, 'bg-red-300', 'border-red-500', 'font-bold', 'text-red-800');
            }
        }

        if(Math.floor({{ $ends_at }} - Date.now() / 1000) > 0) {
            updateTimer();
            var intervalId = setInterval(updateTimer, 1000);
        } else {
            document.getElementById('timer').hidden = true;
            dispatchEvent(timerEndedEvent);
        }
    });
</script>