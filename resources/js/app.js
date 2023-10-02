import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const channel = Echo.channel('public.status');

channel.subscribed( () => {
    console.log('subscribed!')

}).listen('.offer.status', (event) => {


    let response = event.response;
    console.log(response);
    switch (response.type) {
        case 'offerStatus':
            offerStatusEvent(response.data);
            break;

        case 'error':
            console.log(response);
            break;

        case 'createOffer':
            createCard(response);
            break;

        case 'subStatus':
            updateSubs(response.data);
            break;
    }

});

const userChannel = Echo.private('user.' + userId);

userChannel.subscribed( () => {
    console.log('Слушаем событие')


}).listen('.user.event', (e) => {

    let response = e.response;

    switch (response.type) {
        case 'income':
            incomeVal(response);
            break;

        case 'loss':
            lossVal(response);
            break;

        case 'subInfo':
            addSubInfo(response.data);
            break;
        case 'updateSubStatus':
            updateSubStatus(response.data);
            break;
    }
});

