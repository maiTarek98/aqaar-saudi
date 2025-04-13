require('./bootstrap');
Echo.channel('user.' + userId) // The user-specific channel
    .listen('NotifySubscriberNotification', (event) => {
        console.log('New message:', event.message);
        // You can show a notification or update the UI here
    });
