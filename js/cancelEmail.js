/*
** js file to  handle canceling an email sub **
*/

let targetBtn = document.getElementById('cancelSub');
targetBtn.addEventListener('click', function () {
    const emailData = location.search;
    alert(emailData);
});