
function getData(url, target, remove) {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            remove = document.getElementById(remove);
            remove.parentNode.removeChild(remove);
            document.getElementById(target).innerHTML += xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function baseUrl(url) {
    return '/gal/site/' + url;
}

function moreGalleries(offset) {
    document.getElementById('ajax-more-gall-click').setAttribute('onClick', '');
    document.getElementById('ajax-more-gall-info').style.display = 'none';
    document.getElementById('ajax-more-gall-load').style.display = 'block';
    getData(baseUrl('galleries/from/' + offset + '/ajax'), 'main-content', 'ajax-more-gall-click');
}