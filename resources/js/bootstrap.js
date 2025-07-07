import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const reverbHost = import.meta.env.VITE_REVERB_HOST || window.location.hostname;
const reverbPort = Number(import.meta.env.VITE_REVERB_PORT || 8090);
const reverbTLS = import.meta.env.VITE_REVERB_TLS === 'true';

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: reverbHost,
    wsPort: reverbPort,
    wssPort: reverbPort,
    forceTLS: reverbTLS,
    encrypted: reverbTLS,
    enabledTransports: reverbTLS ? ['wss'] : ['ws'],
});

const socket = new WebSocket("ws://localhost:8080/app/laravel-herd?protocol=7&client=js&version=8.4.0&flash=false");

socket.onopen = () => console.log("✅ Connected");
socket.onerror = (e) => console.error("❌ WebSocket error", e);

window.socket = socket;