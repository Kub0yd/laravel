
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

    let modalBody = document.querySelector('.modal-body');
    let offers = response.offer;
    offers.forEach(offer =>{
        console.log(offer);
    })

    // console.log(response.offer);
}
