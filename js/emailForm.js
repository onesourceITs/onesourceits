document.querySelector('#emailForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let formData = $('#emailForm').serialize();
    $.post('classes/starter.php?action=Contact.addContact', formData, function (d) {
        alert(d);
        return false;
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