
const myModalEl = document.querySelector('.modal')
const modalButton = document.querySelectorAll('.modal-act')
modalButton.forEach(item => {
    item.addEventListener('click', () =>{



            // let modalBody = document.querySelector('.modal-body');
            // modalBody.textContent = '13123123';
            offerTable = item.parentNode.parentNode.previousElementSibling;
            offerId = offerTable.querySelector('.offer-id').textContent.substring(1);
            axios.post('admin', {
                // data: {offer_id: 2},
                type: 'getOfferInfo',
                _method: 'post',
                offer_id: offerId,
            })


    })
})
function test(){
    console.log('admin even 2');
}
function createOfferInfo(response){

    var tbody = document.querySelector('.offer-user-info');
    tbody.innerHTML = '';
    let offers = response.offer;
    offers.forEach(offer =>{
        generateSubsTable(offer);
        // console.log(offer);
    })


}

function generateSubsTable(offer){
    var tr = document.createElement('tr');
    tr.classList.add('offer-user-info');

    var th = document.createElement('th');
    th.setAttribute('scope', 'row');

    var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    if (offer.is_active){
        svg.classList.add('offer-indicator', 'active-indicator');
        svg.setAttribute('fill', 'green');
    }else{
        svg.classList.add('offer-indicator', 'inactive-indicator');
        svg.setAttribute('fill', 'red');
    }
    svg.setAttribute('width', '16');
    svg.setAttribute('height', '16');

    svg.setAttribute('viewBox', '0 0 16 20');

    var circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
    circle.setAttribute('cx', '8');
    circle.setAttribute('cy', '8');
    circle.setAttribute('r', '8');

    svg.appendChild(circle);
    th.appendChild(svg);

    var td1 = document.createElement('td');
    var span1 = document.createElement('span');
    span1.classList.add('offer-id');
    span1.textContent = offer.user_id;
    td1.appendChild(span1);

    var td2 = document.createElement('td');
    var span2 = document.createElement('span');
    span2.classList.add('creator');
    span2.textContent = offer.user_name;
    td2.appendChild(span2);

    var td3 = document.createElement('td');
    var a = document.createElement('a');
    a.href = offer.user_personalURL;
    a.textContent = offer.user_personalURL;
    td3.appendChild(a);

    var td4 = document.createElement('td');
    var span4 = document.createElement('span');
    span4.textContent = offer.user_income + '₽';
    td4.appendChild(span4);

    var td5 = document.createElement('td');
    var span5 = document.createElement('span');
    span5.textContent = '';
    offer.user_roles.forEach(role => {
        span5.textContent = span5.textContent + role.name + " ";
    })
    // span5.textContent = 'Webmaster, Admin, Creator';
    td5.appendChild(span5);

    // Добавляем элементы в родительский элемент
    tr.appendChild(th);
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);

    // Находим родительский элемент и добавляем созданный элемент в него
    var tbody = document.querySelector('.offer-user-info');
    tbody.appendChild(tr);
}
