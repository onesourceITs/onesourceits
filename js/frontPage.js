/*
** Front Page JS
** Handles the javascript that is custom on the front end
** Author: Keith Blackwelder
** Date: 03/11/2020
*/

// handle the website pachage links
let Gold = document.getElementById('gold');
let Silver = document.getElementById('silver');
let Bronze = document.getElementById('bronze');

Gold.addEventListener('click', function(event) {
    event.preventDefault();
    alert('the default function of this link has been prevented.');
});

Silver.addEventListener('click', function (event) {
    event.preventDefault();
    alert('the default function of this link has been prevented.');
});

Bronze.addEventListener('click', function (event) {
    event.preventDefault();
    alert('the default function of this link has been prevented.');
});