
const myModalEl = document.querySelector('.modal')
const modalButton =document.querySelector('.modal-act')
modalButton.addEventListener('click', () =>{



        let modalBody = document.querySelector('.modal-body');
        modalBody.textContent = '13123123';
        offerId = modalButton.closest('.container')
        // axios.post('admin', {
        //     // data: {offer_id: 2},
        //     type: 'getOfferInfo',
        //     _method: 'post',
        //     offer_id: 1,
        // })
        console.log(offerId);

})
// myModalEl.addEventListener('show.bs.modal', function (event) {

//     let modalBody = document.querySelector('.modal-body');
//     modalBody.textContent = '13123123';
//     offerId = myModalEl.closest('.offer-id')
//     // axios.post('admin', {
//     //     // data: {offer_id: 2},
//     //     type: 'getOfferInfo',
//     //     _method: 'post',
//     //     offer_id: 1,
//     // })
//     console.log(offerId);
// })
