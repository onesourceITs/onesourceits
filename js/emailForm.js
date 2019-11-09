$(function () {
    $('#emailForm').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'classes/contact.php?request=sendEmail',
            beforeSend: function () {
                $('#sendMessage').attr('disabled', 'true');
                createElement('span', '#sendMessage', 'prepend', attributes = [{
                    'name': 'class',
                    'value': 'spinner-border spinner-border-lg text-success'
                }, {
                    'name': 'role',
                    'value': 'status'
                }, {
                    'name': 'aria-hidden',
                    'value': 'true'
                }, {
                    'name': 'id',
                    'value': 'spinnerBtn'
                }]);

                createElement('span', '#sendMessage', 'append', attributes = [{
                    'name': 'class',
                    'value': 'sr-only'
                }, {
                    'name': 'html',
                    'value': 'Processing...'
                }]);
            },
            data: formData
        }).done(function (d) {
            let dataObj = JSON.parse(d);
            if (dataObj.response == 1) {
                $('#modal-header').fadeOut(750, function () {
                    $('#modal-header').html('Thank You for Contacting Us!');
                    $('#modal-header').fadeIn(750);
                });

                $('#modal-body').fadeOut(750, function () {
                    $('#modal-body').html('A person from our team, will be in contact with you showrtly.');
                    $('#modal-body').append('<br/><button type="button" class="btn btn-danger mt-3" data-dismiss="modal">CLOSE</button>');
                    $('#modal-body').fadeIn(750);
                });
            } else {
                alert('an error has occured.' + d);
            }
        });
    });
});