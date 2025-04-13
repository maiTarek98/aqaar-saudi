import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '2cdefdace59fe00f73f7', // Use your own Pusher key or WebSocket key
    cluster: 'eu',
    forceTLS: true,
});
