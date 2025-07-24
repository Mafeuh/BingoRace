console.log('Echo.js chargé !');

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_CLUSTER,
    forceTLS: true,
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
});

// Debug pour voir les connexions
window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('✅ Echo connecté');
});

window.Echo.connector.pusher.connection.bind('error', (error) => {
    console.error('❌ Erreur Echo:', error);
});