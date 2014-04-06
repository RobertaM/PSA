
function getData(url, target, remove, callback) {
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
            if (remove !== null) {
                remove = document.getElementById(remove);
                remove.parentNode.removeChild(remove);
            }
            if (target !== null) {
                document.getElementById(target).innerHTML += xmlhttp.responseText;
            }
            if (callback !== null) {
                callback(xmlhttp);
            }

        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function baseUrl(url) {
    return '/PSA/site/' + url;
}

function addToCart(string) {
    getData(baseUrl('cart/add/' + string), null, null, function(xmlhttp) {
        console.log(xmlhttp.responseText);
    });
}

function moreGalleries(offset) {
    document.getElementById('ajax-more-gall-click').setAttribute('onClick', '');
    document.getElementById('ajax-more-gall-info').style.display = 'none';
    document.getElementById('ajax-more-gall-load').style.display = 'block';
    getData(baseUrl('galleries/from/' + offset + '/ajax'), 'main-content', 'ajax-more-gall-click');
}