
function send(url, callback) {
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
            if (callback !== null) {
                // Use callback function
//                console.log(xmlhttp.responseText);
                callback(JSON.parse(xmlhttp.responseText));
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
    send(baseUrl('cart/add/' + string), function(jsonResult) {
        console.log(jsonResult);
    });
}

function submitOrders() {
    // Send request
    send(baseUrl('cart/submit'), function(jsonResult) {

        // Request callback
        console.log(jsonResult);
        
     
    });
}

function clearCart() {
    send(baseUrl('cart/clear'), function(jsonResult) {
        console.log(jsonResult);
    });
}