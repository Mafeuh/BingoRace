<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test Pusher/Echo Minimal</title>
</head>
<body>
    <h1>Test Laravel Echo + Pusher</h1>
    <pre id="log"></pre>

    <!-- Pusher depuis jsDelivr -->
    <script src="https://cdn.jsdelivr.net/npm/pusher-js@8.4.0/dist/web/pusher.min.js"></script>
    <!-- Laravel Echo depuis jsDelivr -->
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.2/dist/echo.iife.js"></script>

    <script>
        const log = (msg) => {
            console.log(msg);
            document.getElementById('log').textContent += msg + "\n";
        };

        Pusher.logToConsole = true;

        // ⚠️ Mets ici TES vraies infos Pusher
        const options = {
            broadcaster: 'pusher',
            key: 'e58090be01d1a21dc0de', // <-- remplace
            cluster: 'eu',                  // <-- adapte si besoin
            forceTLS: true,
            wsHost: 'ws-eu.pusher.com',     // <-- adapte si besoin
            wsPort: 443,
            wssPort: 443,
            enabledTransports: ['ws', 'wss'],
        };

        console.trace();

        const echo = new Echo(options);

        echo.channel('test')
            .listen('test_event', () => {
                log('Event "test_event" reçu !');
            });

        log('Connexion lancée...');
    </script>
</body>
</html>
