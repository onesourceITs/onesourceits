/*
 ** JS file to handle the form submission for single page website & SEO offer **
 */

$(function () {

    $('#firstOffer').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'classes/contact.php?request=sendEmail',
            beforeSend: function () {
                $('#SendRequest').attr('disabled', 'true');
                createElement('span', '#SendRequest', 'prepend', attributes = [{
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

                createElement('span', '#SendRequest', 'append', attributes = [{
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
                $('#ThankYou').modal('show');
                setTimeout(function () {
                    window.location.replace('https://www.onesourceits.com');
                }, 3000);

                $('#SendRequest').removeAttr('disabled');
                $('#SendRequest').empty();
                $('#SendRequest').html('Send Request!');
                // clear out the input fields
                $('input').val('');
                $('textarea').val('');
            } else {
                alert('Error in recieving the data:' + d);
            }
        });
    });

});