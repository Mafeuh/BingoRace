import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    encrypted: true,
    enabledTransports: ['ws', 'wss'],
});

// Debug pour voir les connexions
window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('✅ Echo connecté à Reverb');
});

window.Echo.connector.pusher.connection.bind('error', (error) => {
    console.error('❌ Erreur Echo:', error);
});