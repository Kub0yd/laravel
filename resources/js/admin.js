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

const adminChannel = Echo.private('admin.channel');
adminChannel.subscribed( () => {
    test();


}).listen('.admin.event', (event) => {
    // console.log(123);
    let response = event.response;
    console.log(response);

    switch (response.type) {
        case 'sendOfferInfo':
            createOfferInfo(response);
        break;
    }

});


