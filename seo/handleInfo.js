// create data object for info
var dataObj = [
    'Total clicks is how many times a user clicked through to your site. How this is counted depends on the search result type.',
    'Total impressions is how many times a user saw a link to your site in search results. This is calculated differently for images and other search result types, depending on whether or not the result was scrolled into view.',
    'The click through rate, is the clicks multiplied by the impressions. The higher this number, the more web traffic',
    'The average ranking of your website URLs for the query or queries. For example, if your sites URL appeared at position 3 for one query and position 7 for another query, the average position would be 5((3 + 7) / 2).'
];

var elArr = document.getElementById('tableHeader').children;
for (var x = 0; x < elArr.length; x++) {
    elArr[x].addEventListener('click', function (event) {
        event.preventDefault();
        determineClick(this.id);
    });
}

function determineClick(id) {
    // determine what2do with the id paramiter

    var modalBody = document.getElementById('modalBody');
    if (id == 'clicks') {
        modalBody.innerHTML = dataObj[0];
        $('#infoModals').modal('show');
    } else if (id == 'impressions') {
        modalBody.innerHTML = dataObj[1];
        $('#infoModals').modal('show');
    } else if (id == 'ctr') {
        modalBody.innerHTML = dataObj[2];
        $('#infoModals').modal('show');
    } else {
        modalBody.innerHTML = dataObj[3];
        $('#infoModals').modal('show');
    }
}

$('button[data-dismiss=modal]').click(function(){
    $('div[role=table]').focus();
});