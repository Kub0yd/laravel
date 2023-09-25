let offerStatusCheckBox = document.querySelectorAll('#flexSwitchCheckDefault');
let offerCardsPanel = document.querySelector('.offer-cards-panel');
const offersPanel = document.querySelector('.offers-list');
const subscribeButton =  document.querySelectorAll('.offer-subscribe');

// var app = {{ Illuminate\Support\Js::from($array) }};
// const userChannel = Echo.private('user.'.userId);

// userChannel.listen('OrderShipmentStatusUpdated', (e) => {
//     console.log(e);
// });


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

subscribeButton.forEach(item => {

    item.addEventListener('click', function(e) {
        e.preventDefault();

        let offerIdDiv = item.closest('.container').querySelector('.offer-id');
        let buttonValue =  item.closest('.container').querySelector("input[name='subscription']");
        let subsPanel = document.querySelector('.subs-list');
        let offerDiv = item.closest('.offer-cards-panel');
        let subButton = item.querySelector('.btn');

        let offerId = offerIdDiv.textContent.trim().substring(1);
        request = '';
        if (buttonValue.value === 'unsubscribe'){

            // subButton = item.querySelector('.btn');
            buttonValue.value = 'subscribe';
            subButton.classList.remove('btn-secondary');
            subButton.classList.add('btn-primary');
            subButton.textContent = 'Sub';
            offersPanel.append(offerDiv);
            personalUrl = offerDiv.querySelector('.user-url');
            personalUrl.remove();
            request = 'unsubscribe';

        }else if(buttonValue.value === 'subscribe'){

            subsPanel.append(offerDiv);
            buttonValue.value = 'unsubscribe';
            subButton.classList.remove('btn-primary');
            subButton.classList.add('btn-secondary');
            subButton.textContent = 'Unsub';

            request = 'subscribtion';
        }
        axios.post('main', {
            // data: {offer_id: 2},
            _method: 'post',
            type: request,
            offer_id: offerId,
        })
    })
})

function incomeVal(response){

    const offerSubsCount = document.querySelector('.offer-card-id-' + response.offer_id);
    const offerIncome = offerSubsCount.querySelector('#offer-income');
    // console.log(response);
    income = offerIncome.textContent.replace(/[^0-9,.]/g,"");
    let newIncome = parseFloat(income) + response.income;
    offerIncome.textContent = "Доход: " +(Number(newIncome.toFixed(2)).toString(10)) + "₽";

    //Statisctic modal
    const offerStat = document.querySelector('#offer-' + response.offer_id + '-statistic');

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
function lossVal(response){
    const offerSubsCount = document.querySelector('.offer-card-id-' + response.offer_id);
    const offerLoss = offerSubsCount.querySelector('#offer-loss');
    // console.log(response);
    loss = offerLoss.textContent.replace(/[^0-9,.]/g,"");
    let newLoss = parseFloat(loss) + parseFloat(response.loss);
    // console.log( newLoss);
    offerLoss.textContent = "Расход: " +(Number(newLoss.toFixed(2)).toString(10)) + "₽";
    //Statisctic modal
    const offerStat = document.querySelector('#offer-' + response.offer_id + '-statistic');

    const offerStatLoss = offerStat.querySelectorAll('.loss-stat');
    const offerStatrans = offerStat.querySelectorAll('.transitions-stat');
    console.log(offerStatrans);
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
//переделать
    let offerCard = document.querySelector('.offer-card-id-'+event.offer_id);

    if (offerCard && offerCard.closest('.offers-list') && !event.is_active){
        console.log(offerCard);
        offerCard.remove();
    }
    // let offerSubButton = document.querySelector('#offer-id-' + event.offer_id + '-button');
    // let offerCard = document.querySelector('#offer-id-' + event.offer_id);
    // if (event.is_active && offerSubButton){
    //     offerSubButton.classList.remove('disabled');
    // }else if (!event.is_active && offerSubButton) {
    //     offerSubButton.classList.add('disabled');
    // }else if (!offerSubButton && !offerCard){
    //     createCard (event);
    // }
}


function updateSubs(response){
    // console.log(response);
    let offerSubsCount = document.querySelector('.offer-' + response.offer_id + '-subs');

    if (offerSubsCount){
        // console.log(response);
        offerSubsCount.textContent = "Subs: " + response.offer_subs;
    }
}

function addSubInfo(response){
    // console.log(response);
    createUserSubURL(response);

}

let test = document.querySelector('.offer-card-id-1');
test.addEventListener('click', () => {
    if (test.closest('.container').classList.contains('subs-list')){
            console.log(123)
    }
    console.log(test.closest('.offers-list'))
})

//

function createUserSubURL(data){
    let sub = document.querySelector('.offer-card-id-'+data.offer_id);
    console.log(sub);
    let row = document.createElement('div');
    row.classList.add('row', 'justify-content-around', 'user-url');

    let col = document.createElement('div');
    col.classList.add('col-auto');

    let span = document.createElement('span');
    span.textContent = 'Разместите на своем сайте: ';

    let link = document.createElement('a');
    link.href = data.sub_url;
    link.classList.add('link-success', 'link-offset-2', 'link-underline-opacity-25', 'link-underline-opacity-100-hover');
    link.textContent = data.sub_url;

    span.appendChild(link);
    col.appendChild(span);
    row.appendChild(col);

    sub.appendChild(row);
}

function createCard (response){
    let div = document.createElement("div");
div.className = "row offer-cards-panel";

let form = document.createElement("form");
form.method = "POST";
form.action = "http://localhost/main";

let input = document.createElement("input");
input.type = "hidden";
input.name = "_token";
input.value = "";
form.appendChild(input);

let container = document.createElement("div");
container.className = "container rounded-pill border border-2 border-secondary bg-dark bg-gradient text-white";

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
col2_2.className = "col";

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
row3.className = "row align-items-center offer-4-subs";

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
col10.className = "col-sm order-12 d-flex justify-content-end";
let button = document.createElement("button");
button.className = "btn btn-primary col";
button.id = "offer-id-4-button";
button.type = "submit";
button.textContent = "Sub";
let input1 = document.createElement("input");
input1.type = "hidden";
input1.name = "subscription";
input1.value = "subscribe";
let input2 = document.createElement("input");
input2.type = "hidden";
input2.name = "offer_id";
input2.value = "4";

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
form.appendChild(container);
div.appendChild(form);

offersPanel.appendChild(div);
}
