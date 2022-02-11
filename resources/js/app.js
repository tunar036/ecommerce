require('./bootstrap');


setTimeout(() => {
    $('.alert').slideUp(500);
}, 10000);


        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

