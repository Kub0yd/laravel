let offerStatusCheckBox = document.querySelector('#flexSwitchCheckDefault');






offerStatusCheckBox.addEventListener('change', function() {
    if (this.checked){
        axios.post('main/1', {
            // data: {offer_id: 2},
            _method: 'put',
            is_active: true,
            offer_id: 1,
        })
            // .then(function (response) {
            //     console.log(response)
            // })
            // .catch(function (error) {
            //         console.log(error.response.data)

            // })
    }else{
        axios.post('main/offer', {
            data: {test: 'test'},
            _method: 'put',
            is_active:false,
        })
    }

})

