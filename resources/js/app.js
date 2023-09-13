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

        case 'createOffer':
            createCard(response);
            break;

        case 'subStatus':
            updateSubs(response);
            break;
    }

});

const userChannel = Echo.private('user.' + userId);

userChannel.subscribed( () => {
    console.log('Слушаем событие')
}).listen('.user.event', (e) => {
    console.log(e);
});
// userChannel.listen('.user.event', (e) => {
//     console.log(e);
// });
// const channel = Echo.channel('private.playground.1');

// channel.subscribed( () => {
//     console.log('subscribed!');
// }).listen('.playground', (event) => {
//     console.log(event);
// });
