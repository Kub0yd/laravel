import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
const channel = Echo.channel('public.status');

channel.subscribed( () => {
    console.log('subscribed!')
}).listen('.offer.status', (event) => {


    let response = event.response;
    switch (response.type) {
        case 'offerStatus':
            offerStatusEvent(response);
            break;

        case 'error':
            console.log(response);
            break;
    }

});
// const channel = Echo.channel('private.playground.1');

// channel.subscribed( () => {
//     console.log('subscribed!');
// }).listen('.playground', (event) => {
//     console.log(event);
// });
