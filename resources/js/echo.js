import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

Pusher.logToConsole = true;



(function () {
    const origSubscribe = Pusher.prototype.subscribe;
    Pusher.prototype.subscribe = function (channelName) {
        console.log('[DEBUG] Tentative abonnement ->', channelName);
        return origSubscribe.apply(this, arguments);
    };
})();

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    wsHost: import.meta.env.VITE_PUSHER_HOST,
    wsPort: import.meta.env.VITE_PUSHER_PORT,
    wssPort: import.meta.env.VITE_PUSHER_PORT,
    enabledTransports: ["ws", "wss"],
});

window.Echo.channel('test').listen('test_event', function() {
    console.log('Test event reçu !');
});

window.Echo.connector.pusher.connection.bind('state_change', states => {
    console.log('Pusher state change:', states);
});