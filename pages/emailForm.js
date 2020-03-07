
document.querySelector('#emailForm').addEventListener('submit', function (e) {
    e.preventDefault();
    $.post('../classes/starter.php?action=Insert', {
        email: '' + document.getElementById('email').value + '',
        subject: '' + document.getElementById('Subject').value + '',
        message: '' + document.getElementById('message').value + ''
    }, function (d) {
        alert(d);
        return false;
        let dataObj = JSON.parse(d);
        if (dataObj.msg == 'true') {
            document.getElementById('modal-header').innerHTML = 'Thank You for Contacting Us!';
            document.getElementById('modal-body').innerHTML = 'A person from our team, will be in contact with you shortly.';
        } else {
            alert('an error has occured.' + d);
        }
    });

});