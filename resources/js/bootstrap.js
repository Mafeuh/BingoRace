import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const reverbHost = import.meta.env.VITE_REVERB_HOST || window.location.hostname;
const reverbPort = parseInt(import.meta.env.VITE_REVERB_PORT || 6001);
const reverbTLS = import.meta.env.VITE_REVERB_SCHEME === 'https';

Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: reverbHost,
    wsPort: reverbPort,
    wssPort: reverbPort,
    forceTLS: reverbTLS,
    encrypted: reverbTLS,
    enabledTransports: reverbTLS ? ['wss'] : ['ws'],
    disableStats: true,
});
