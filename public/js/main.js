const parent = document.body;
const offerStatusCheckBox = document.querySelectorAll('#flexSwitchCheckDefault');
const offerCardsPanel = document.querySelector('.offer-cards-panel');
const offersPanel = document.querySelector('.offers-list');
const subscribeButton =  document.querySelectorAll('.offer-subscribe');
const balance = document.querySelector('.balance');


offerStatusCheckBox.forEach(item => {

    item.addEventListener('change', function() {

        // let offerMark = this.closest('.offer-id').querySelector('.offer-id');
        let offerMark = this.closest('.container').querySelector('.offer-id');
        let indicator = this.closest('.container').querySelector('.offer-indicator');
        let offerId = offerMark.textContent.trim().substring(1);
        let status = false;
        if (this.checked){
            status = true;
        }
        if (status){
            indicator.classList.remove('inactive-indicator');
            indicator.classList.add('active-indicator');
            indicator.style.fill = 'green'
        }else{
            indicator.classList.remove('active-indicator');
            indicator.classList.add('inactive-indicator');
            indicator.style.fill = 'gray'
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
parent.addEventListener('click', (event) =>{

    if (event.target.classList.contains('sub-button')){
        let offerIdDiv = event.target.closest('.container').querySelector('.offer-id');
        let buttonValue =  event.target.closest('.container').querySelector("input[name='subscription']");
        let subsPanel = document.querySelector('.subs-list');
        let offerDiv = event.target.closest('.offer-cards-panel');
        let subButton = event.target;

        let offerId = offerIdDiv.textContent.trim().substring(1);

        request = '';
        if (buttonValue.value === 'unsubscribe'){
            // subButton = item.querySelector('.btn');
            buttonValue.value = 'subscribe';
            subButton.classList.remove('btn-secondary');
            subButton.classList.add('btn-primary');
            subButton.textContent = 'подписаться';
            offersPanel.append(offerDiv);
            personalUrl = offerDiv.querySelector('.user-url');
            if (personalUrl){
                personalUrl.remove();
            }

            request = 'unsubscribe';

        }else if(buttonValue.value === 'subscribe'){

            subsPanel.append(offerDiv);
            buttonValue.value = 'unsubscribe';
            subButton.classList.remove('btn-primary');
            subButton.classList.add('btn-secondary');
            subButton.textContent = 'Отписаться';

            request = 'subscription';
        }
        axios.post('main', {
            _method: 'post',
            type: request,
            offer_id: offerId,
        })
    }

})


function incomeVal(response){

    const offerSubsCount = document.querySelector('.offer-card-id-' + response.offer_id);
    const offerIncome = offerSubsCount.querySelector('#offer-income');

    income = offerIncome.textContent.replace(/[^0-9,.]/g,"");
    let newIncome = parseFloat(income) + response.income;
    offerIncome.textContent = "Доход: " +(Number(newIncome.toFixed(2)).toString(10)) + "₽";

    let balanceArray = balance.textContent.split(": ");
    let newBalanceLoss =  parseFloat(balanceArray[1]) + parseFloat(response.income);
    balance.textContent = "Баланс: " +(Number(newBalanceLoss.toFixed(2)).toString(10)) + "₽";
    //Statisctic modal
    const offerStat = document.querySelector('#offer-' + response.offer_id + '-statistic');
    if (offerStat){
        const offerStatIncome = offerStat.querySelectorAll('.income-stat');
        const offerStatrans = offerStat.querySelectorAll('.transitions-stat');

        offerStatIncome.forEach(item => {
            offerStatNewIncome = parseFloat(item.textContent) + parseFloat(response.income);
            item.textContent = Number(offerStatNewIncome.toFixed(2)).toString(10);
        })
        offerStatrans.forEach(item => {
            item.textContent = parseInt(item.textContent) + 1;
        })
    }
    }

function lossVal(response){
    const offerSubsCount = document.querySelector('.offer-card-id-' + response.offer_id);
    const offerLoss = offerSubsCount.querySelector('#offer-loss');

    loss = offerLoss.textContent.replace(/[^0-9,.]/g,"");
    let newLoss = parseFloat(loss) + parseFloat(response.loss);

    offerLoss.textContent = "Расход: " +(Number(newLoss.toFixed(2)).toString(10)) + "₽";

    let balanceArray = balance.textContent.split(": ");
    let newBalanceLoss =  parseFloat(balanceArray[1]) - parseFloat(response.loss);
    balance.textContent = "Баланс: " +(Number(newBalanceLoss.toFixed(2)).toString(10)) + "₽";

    const offerStat = document.querySelector('#offer-' + response.offer_id + '-statistic');

    const offerStatLoss = offerStat.querySelectorAll('.loss-stat');
    const offerStatrans = offerStat.querySelectorAll('.transitions-stat');

    offerStatLoss.forEach(item => {
        offerStatNewLoss = parseFloat(item.textContent) + parseFloat(response.loss);
        item.textContent = Number(offerStatNewLoss.toFixed(2)).toString(10);
    })

    offerStatrans.forEach(item => {
        value = parseInt(item.textContent);
        item.textContent = value + 1;
    })
}



function offerStatusEvent(event){

    let offerCard = document.querySelector('.offer-card-id-'+event.offer_id);

    if (offerCard && offerCard.closest('.offers-list') && !event.is_active){

        offerCard.remove();
    }else if(!offerCard){
        createCard (event);
    }
}


function updateSubs(response){

    let offerSubsCount = document.querySelector('.offer-' + response.offer_id + '-subs');

    if (offerSubsCount){

        offerSubsCount.textContent = "Subs: " + response.offer_subs;
    }
}
function updateSubStatus(response){
    // let offerCard = document.querySelector('.offer-card-id-'+response.offer_id);

    response.offer_active ? activateSub(response) : disactivateSub(response);
}

function disactivateSub(response){
    let offerCard = document.querySelector('.offer-card-id-'+response.offer_id);
    if (offerCard){
        let indicator = offerCard.querySelector('svg');
        let urlField = offerCard.querySelector('.user-url')
        indicator.classList.remove('active-indicator');
        indicator.classList.add('disabled-indicator');
        indicator.style.fill = 'red'
        urlField.remove();
    }

}
function activateSub(response){

    let offerCard = document.querySelector('.offer-card-id-'+response.offer_id);
    let indicator = offerCard.querySelector('svg');

    indicator.classList.remove('disabled-indicator');
    indicator.classList.add('active-indicator');
    indicator.style.fill = 'green'
    createUserSubURL(response.offer_id, response.user_link);

}

function addSubInfo(response){

    createUserSubURL(response.offer_id, response.sub_url);

}



//

function createUserSubURL(offer_id, sub_url){
    let sub = document.querySelector('.offer-card-id-'+offer_id);

    let row = document.createElement('div');
    row.classList.add('row', 'justify-content-around', 'user-url');

    let col = document.createElement('div');
    col.classList.add('col-auto');

    let span = document.createElement('span');
    span.textContent = 'Разместите на своем сайте: ';

    let link = document.createElement('a');
    link.href = sub_url;
    link.classList.add('link-success', 'link-offset-2', 'link-underline-opacity-25', 'link-underline-opacity-100-hover');
    link.textContent = sub_url;

    span.appendChild(link);
    col.appendChild(span);
    row.appendChild(col);

    sub.appendChild(row);
}

function createCard (response){
    let div = document.createElement("div");
div.className = "row offer-cards-panel";

let container = document.createElement("div");
container.className = "container rounded-pill border border-2 border-secondary bg-dark bg-gradient text-white offer-card-id-" + response.offer_id;

let row1 = document.createElement("div");
row1.className = "row align-items-center ";

let col1 = document.createElement("div");
col1.className = "col-sm-auto";

let row2 = document.createElement("div");
row2.className = "row align-items-center";

let col2_1 = document.createElement("div");
col2_1.className = "col";

let svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
svg.setAttribute("class", "offer-indicator active-indicator");
svg.setAttribute("width", "16");
svg.setAttribute("height", "16");
svg.setAttribute("fill", "green");
svg.setAttribute("viewBox", "0 0 16 20");

let circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
circle.setAttribute("cx", "8");
circle.setAttribute("cy", "8");
circle.setAttribute("r", "8");

svg.appendChild(circle);
col2_1.appendChild(svg);

let col2_2 = document.createElement("div");
col2_2.id = "offer-id-" + response.offer_id;
col2_2.textContent = "#" + response.offer_id;
col2_2.className = "col offer-id";

row2.appendChild(col2_1);
row2.appendChild(col2_2);
col1.appendChild(row2);

let col3 = document.createElement("div");
col3.className = "col-sm-auto";
let span = document.createElement("span");
span.className = "cart-text";
span.textContent = "By: " + response.creator;
col3.appendChild(span);

let col4 = document.createElement("div");
col4.className = "col-lg-auto";
col4.textContent = response.title;

let col5 = document.createElement("div");
col5.className = "col-lg-auto";
let a = document.createElement("a");
a.href = response.URL;
a.textContent = response.URL;
col5.appendChild(a);

let col6 = document.createElement("div");
col6.className = "col-sm-auto";
let span2 = document.createElement("span");
span2.textContent = "Price: "+ response.price + " ₽";
col6.appendChild(span2);

let col7 = document.createElement("div");
col7.className = "col-lg order-12 d-flex justify-content-end";

let row3 = document.createElement("div");
row3.className = "row align-items-center offer-"+response.offer_id+"-subs-row";

let statButtonCol = document.createElement("div");
statButtonCol.className = "col-auto offer-statistic-button";
let statButton = document.createElement("button");
statButton.type = "button";
statButton.className = "btn  btn-sm btn-primary";
statButton.dataset.bsToggle = "modal";
statButton.dataset.bsTarget = "#offer-" + response.offer_id +"-statistic";
statButton.textContent = 'Статистика';
statButtonCol.appendChild(statButton);
row3.appendChild(statButtonCol);

let col8 = document.createElement("div");
col8.className = "col-auto";
col8.textContent = "Subs: 0";
row3.appendChild(col8);

let col9 = document.createElement("div");
col9.className = "col-auto";
col9.id = "offer-loss";
let span3 = document.createElement("span");
span3.className = "text-end col";
span3.id = "offer-income";
span3.textContent = "Доход: 0₽";
col9.appendChild(span3);
row3.appendChild(col9);

let col10 = document.createElement("div");
col10.className = "col-sm order-12 d-flex justify-content-end offer-subscribe";
let button = document.createElement("button");
button.className = "btn btn-primary btn-sm col sub-button";
button.id = "offer-id-"+response.offer_id + "-button";
button.type = "submit";
button.textContent = "подписаться";
let input1 = document.createElement("input");
input1.type = "hidden";
input1.name = "subscription";
input1.value = "subscribe";
let input2 = document.createElement("input");
input2.type = "hidden";
input2.name = "offer_id";
input2.value = response.offer_id;

col10.appendChild(button);
col10.appendChild(input1);
col10.appendChild(input2);

row3.appendChild(col10);
col7.appendChild(row3);

row1.appendChild(col1);
row1.appendChild(col3);
row1.appendChild(col4);
row1.appendChild(col5);
row1.appendChild(col6);
row1.appendChild(col7);

container.appendChild(row1);
// form.appendChild(container);
div.appendChild(container);
if (offersPanel){
    offersPanel.appendChild(div);
}

}
