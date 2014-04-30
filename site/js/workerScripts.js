function changeOrderStatus(orderId, newStatus, callback) {
    send(baseUrl('orders/status/' + orderId + "/" + newStatus), callback);
}

function onOrderStatusChange(obj) {
    // Get element status. Get options, get status option, get its name.
    options = obj.options;
    status = options[options.selectedIndex].getAttribute("name");

    // Get order id
    oid = obj.getAttribute("oid");

    // Send data
    changeOrderStatus(oid, status, function(json) {
        console.log(json);
    });
}

function changeUserStatus(newStatus, callback) {
    send(baseUrl("user/setPrivileges/" + newStatus), callback);
}

function onUserStatusChange(obj) {

    // Get element status. Get options, get status option, get its name.
    options = obj.options;
    status = options[options.selectedIndex].getAttribute("name");

    // Send data
    changeUserStatus(status, function(json) {
        console.log(json);
    });
}

function changeWorkerPlace(newStatus, callback) {
    send(baseUrl("user/setPlace/" + newStatus), callback);
}

function onWorkerPlaceChange(obj, uId) {

    options = obj.options;
    placeId = options[options.selectedIndex].getAttribute("name");

    // Send data
    changeWorkerPlace(uId + "/" + placeId, function(json) {
        console.log(json);
    });
}