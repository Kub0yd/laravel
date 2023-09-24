const myModalEl = document.querySelector('.modal')
const offerModalButton = document.querySelectorAll('.modal-act')
const userModalButton = document.querySelectorAll('.user-modal-act')
const checkInput = document.querySelectorAll('.form-check-input')
const userPanelCloseButton = document.querySelector('#user-infopanel-close')
const saveButton = document.querySelector('#post-user-role');
const panelUserName = document.querySelector('.stat-user-name');
const panelUserId = document.querySelector('.stat-user-id');

offerModalButton.forEach(item => {
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
userModalButton.forEach(item => {
    item.addEventListener('click', () =>{



            // let modalBody = document.querySelector('.modal-body');
            // modalBody.textContent = '13123123';
            userDiv = item.closest('.row');
            userName = userDiv.querySelector('.user-name').textContent;

            if (saveButton.classList.contains('btn-primary')){
                saveButton.classList.remove('btn-primary');
                saveButton.classList.add('btn-secondary');
            }

            axios.post('admin', {
                // data: {offer_id: 2},
                type: 'getUserInfo',
                _method: 'post',
                user_name: userName.trim(),
            })


    })
})
function test(){
    console.log('admin even 2');
}
function createOfferInfo(response){

    var tbody = document.querySelector('.offer-user-info');
    tbody.innerHTML = '';
    let offers = response.data;

    offers.forEach(offer =>{
        generateSubsTable(offer);
        // console.log(offer);
    })

}

saveButton.addEventListener('click', () =>{
    if (saveButton.classList.contains('btn-primary')){
        let roles = [];
        checkInput.forEach((checkbox) => {
            if (checkbox.checked){
                roles.push(checkbox.value)
            }
        })
        axios.post('admin', {
            // data: {offer_id: 2},
            type: 'updateUserRoles',
            _method: 'post',
            user_id: panelUserId.textContent,
            user_roles: roles,
        })
        // console.log(roles);
        if (saveButton.classList.contains('btn-primary')){
            saveButton.classList.remove('btn-primary');
            saveButton.classList.add('btn-secondary');
        }
    }
})

function createUserInfo(response){

    const userSubsTable = document.querySelector('.user-subs');
    const userOffersTable = document.querySelector('.user-offers');
    const userIncome = document.querySelector('#total-income');
    const userTransactions = document.querySelector('#total-transactions');


    userSubsTable.innerHTML = '';
    userOffersTable.innerHTML = '';

    let userData = response.data;
    userData.forEach((item) => {

        if (item.hasOwnProperty('sub_data')) {

            createUserSubsTable (item.sub_data)

        }
        if (item.hasOwnProperty('offer_data')) {
          // обработка элемента с offer_data
          createUserOffersTable (item.offer_data)
        }

      });
      userIncome.textContent = userData[0].user_income + '₽';
      userTransactions.textContent = userData[0].user_transactions;
      panelUserName.textContent = userData[0].user_name;
      panelUserId.textContent = userData[0].user_id;

      getUserRoles(userData)
}

function getUserRoles(userData){
    const adminRole = document.querySelector('.role-admin');
    const webmasterRole = document.querySelector('.role-webmaster');
    const creatorRole = document.querySelector('.role-creator');

    const roles = userData[0].user_roles;

    if (roles.includes('admin')){
        adminRole.checked = true;
    }else{
        adminRole.checked = false;
    }
    if (roles.includes('webmaster')){
        webmasterRole.checked = true;
    }else{
        webmasterRole.checked = false;
    }
    if (roles.includes('creator')){
        creatorRole.checked = true;
    }else{
        creatorRole.checked = false;
    }


}

checkInput.forEach((checkBox) => {
    checkBox.addEventListener('click', () => {

        if (saveButton.classList.contains('btn-secondary')){
            saveButton.classList.remove('btn-secondary');
            saveButton.classList.add('btn-primary');
        }

    })
})

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

function createUserOffersTable (data){
    const tr = document.createElement('tr');

    const th = document.createElement('th');
    th.setAttribute('scope', 'row');

    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    if (data.is_active){
        svg.classList.add('offer-indicator', 'active-indicator');
        svg.setAttribute('fill', 'green');
    }else{
        svg.classList.add('offer-indicator', 'inactive-indicator');
        svg.setAttribute('fill', 'red');
    }
    svg.classList.add('offer-indicator', 'active-indicator');
    svg.setAttribute('width', '16');
    svg.setAttribute('height', '16');
    // svg.setAttribute('fill', 'green');
    svg.setAttribute('viewBox', '0 0 16 20');

    const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
    circle.setAttribute('cx', '8');
    circle.setAttribute('cy', '8');
    circle.setAttribute('r', '8');

    svg.appendChild(circle);
    th.appendChild(svg);

    const td1 = document.createElement('td');
    const span1 = document.createElement('span');
    span1.classList.add('offer-id');
    span1.textContent = '#' + data.offer_id;
    td1.appendChild(span1);

    const td2 = document.createElement('td');
    const span2 = document.createElement('span');
    span2.classList.add('title');
    span2.textContent = data.offer_title;
    td2.appendChild(span2);

    const td3 = document.createElement('td');
    const a = document.createElement('a');
    a.setAttribute('href', data.offer_URL);
    a.classList.add('13');
    a.textContent = data.offer_URL;
    td3.appendChild(a);

    const td4 = document.createElement('td');
    const span4 = document.createElement('span');
    span4.textContent = data.offer_price + '₽';
    td4.appendChild(span4);

    const td5 = document.createElement('td');
    const span5 = document.createElement('span');
    span5.textContent = data.offer_subs;
    td5.appendChild(span5);

    const td6 = document.createElement('td');
    const span6 = document.createElement('span');
    span6.textContent = data.offer_loss + '₽';
    td6.appendChild(span6);

    tr.appendChild(th);
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);
    tr.appendChild(td6);
    const userOffersTable = document.querySelector('.user-offers');
    userOffersTable.appendChild(tr);
}

function createUserSubsTable (data){



    const tr = document.createElement('tr');

    const th = document.createElement('th');
    th.setAttribute('scope', 'row');

    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    if (data.is_active){
        svg.classList.add('offer-indicator', 'active-indicator');
        svg.setAttribute('fill', 'green');
    }else{
        svg.classList.add('offer-indicator', 'disabled-indicator');
        svg.setAttribute('fill', 'red');
    }
    svg.setAttribute('width', '16');
    svg.setAttribute('height', '16');
    // svg.setAttribute('fill', 'green');
    svg.setAttribute('viewBox', '0 0 16 20');

    const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
    circle.setAttribute('cx', '8');
    circle.setAttribute('cy', '8');
    circle.setAttribute('r', '8');

    svg.appendChild(circle);
    th.appendChild(svg);

    const td1 = document.createElement('td');
    const span1 = document.createElement('span');
    span1.classList.add('offer-id');
    span1.textContent = '#' + data.offer_id;
    td1.appendChild(span1);

    const td2 = document.createElement('td');
    const span2 = document.createElement('span');
    span2.classList.add('creator');
    span2.textContent = data.offer_creator;
    td2.appendChild(span2);

    const td3 = document.createElement('td');
    const span3 = document.createElement('span');
    span3.classList.add('sub-title');
    span3.textContent = data.offer_title;
    td3.appendChild(span3);

    const td4 = document.createElement('td');
    const a = document.createElement('a');
    a.setAttribute('href', data.user_personalURL);
    a.classList.add('URL');
    a.textContent = data.user_personalURL;
    td4.appendChild(a);

    const td5 = document.createElement('td');
    const span5 = document.createElement('span');
    span5.textContent =  parseFloat(data.sub_income) + '₽';
    td5.appendChild(span5);

    const td6 = document.createElement('td');
    const span6 = document.createElement('span');
    span6.textContent = data.sub_transactions;
    td6.appendChild(span6);

    tr.appendChild(th);
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);
    tr.appendChild(td6);

    const userSubsTable = document.querySelector('.user-subs');
    userSubsTable.appendChild(tr);
}
