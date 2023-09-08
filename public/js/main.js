let offerStatusCheckBox = document.querySelectorAll('#flexSwitchCheckDefault');



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
    console.log(offerSubButtom);
    if (event.is_active && !offerSubButtom == null ){
        offerSubButtom.classList.remove('disabled');
    }else {
        offerSubButtom.classList.add('disabled');
    }
}

