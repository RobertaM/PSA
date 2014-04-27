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