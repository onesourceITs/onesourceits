$(function () {
    $('a.js-scroll-trigger').click(function () {
        let id= $(this).attr('id');
        if (id == "aboutLink"){
            var focusId = "about";
        } else if (id == "SearchEngine") {
            var focusId = "SEO";
        } else if (id == "SinglePageAds"){
            var focusId = "SPADS";
        } else if (id == "WebSiteDevelopment") {
            var focusId = "WSD";
        } else if (id == "contactLink" ){
            var focusId = "contact";
        } else {
            var focusId = "ADA";
        }

        $(`#${focusId}`).focus();
        if (id == "SearchEngine" || id == "SinglePageAds" || id == "WebSiteDevelopment" || id == "ADAWebCompliance") {
            $('.dropdown-toggle').click();
        }
    });
});