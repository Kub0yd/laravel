let offerStatusCheckBox = document.querySelectorAll('#flexSwitchCheckDefault');
let offerCardsPanel = document.querySelector('.offer-cards-panel');



offerStatusCheckBox.forEach(item => {

    item.addEventListener('change', function() {

        let offerMark = this.closest('.card').querySelector('.my-offer');
        let offerId = offerMark.textContent.substring(1);

        let status = false;
        if (this.checked){
            status = true;
        }

            axios.post('main/1', {
                // data: {offer_id: 2},
                type: 'offerStatus',
                _method: 'put',
                is_active: status,
                offer_id: offerId,
            })


        })
})

function offerStatusEvent(event){
//переделать
    let offerSubButtom = document.querySelector('#offer-id-' + event.offer_id + '-button');
    let offerCard = document.querySelector('#offer-id-' + event.offer_id);
    console.log(offerSubButtom);
    if (event.is_active && offerSubButtom){
        offerSubButtom.classList.remove('disabled');
    }else if (!event.is_active && offerSubButtom) {
        offerSubButtom.classList.add('disabled');
    }else if (!offerSubButtom && !offerCard){
        createCard (event);
        console.log(event);
    }
}

function updateSubs(response){

    let offerSubsCount = document.querySelector('.offer-' + response.offer_id + '-subs');

    if (offerSubsCount){
        console.log(response);
        offerSubsCount.textContent = "Подписок: " + response.offer_subs;
    }
}


function createCard (response){
    const colSmDiv = document.createElement("div");
    colSmDiv.classList.add("col-sm");

    const cardDiv = document.createElement("div");
    cardDiv.classList.add("card", "border-dark", "mb-3");
    cardDiv.style.minWidth = "200px";

    const cardHeaderDiv = document.createElement("div");
    cardHeaderDiv.classList.add("card-header");

    const rowDiv = document.createElement("div");
    rowDiv.classList.add("row");

    const textP1 = document.createElement("p");
    textP1.classList.add("text", "col");
    textP1.textContent = response.title;

    const textEndP = document.createElement("p");
    textEndP.classList.add("text-end", "col");
    textEndP.id = "offer-id-" + response.offer_id;
    textEndP.textContent = "#" + response.offer_id;

    rowDiv.appendChild(textP1);
    rowDiv.appendChild(textEndP);
    cardHeaderDiv.appendChild(rowDiv);
    cardDiv.appendChild(cardHeaderDiv);

    const cardBodyDiv = document.createElement("div");
    cardBodyDiv.classList.add("card-body");

    const cardSubtitleH6 = document.createElement("h6");
    cardSubtitleH6.classList.add("card-subtitle", "mb-2", "text-muted");
    cardSubtitleH6.textContent = response.URL;

    const cartTextP = document.createElement("p");
    cartTextP.classList.add("cart-text");
    cartTextP.textContent = "By: " + response.creator;

    const rowDiv2 = document.createElement("div");
    rowDiv2.classList.add("row");

    const button = document.createElement("button");
    button.classList.add("btn", "btn-primary", "col");
    button.id = "offer-id-" + response.offer_id + "-button";
    button.type = "submit";
    button.textContent = "Sub";

    const textEndP2 = document.createElement("p");
    textEndP2.classList.add("text-end", "col");
    textEndP2.textContent = response.price + " ₽";

    rowDiv2.appendChild(button);
    rowDiv2.appendChild(textEndP2);
    cardBodyDiv.appendChild(cardSubtitleH6);
    cardBodyDiv.appendChild(cartTextP);
    cardBodyDiv.appendChild(rowDiv2);
    cardDiv.appendChild(cardBodyDiv);

    colSmDiv.appendChild(cardDiv);
    offerCardsPanel.appendChild(colSmDiv);
}
