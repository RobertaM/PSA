<h3><?php echo $title . ": " . $restaurant["name"]; ?></h3>
<div id="all-orders">
    <?php
    // See later if id is the same
    $last_id = -1;
    $order_id;
    for ($i = 0; $i < sizeof($orders); $i++) {
        if ($orders[$i]["order_id"] !== $last_id) {
            ?>
            <div class="place-item btn btn-active btn-full btn-square default-cursor">
                <div class="max-element-height">
                    <div class="fifth left ellipsize"><h5><?php echo $orders[$i]["date_received"] ?></h5></div>
                    <div class="threefifth left ellipsize"><h5><?php echo "Order id: " . $orders[$i]["order_id"] ?></h5></div>
                    <div id="status-select-<?php echo $orders[$i]["order_id"]; ?>" class="fifth right">
                        <label for="order-state">
                            Change order status
                            <select id='order-state-select' class="btn btn-small btn-square btn-full" onchange="onOrderStatusChange(this);"  oid="<?php echo $orders[$i]["order_id"]; ?>">
                                <?php
                                $states = $this->Order_model->get_available_order_states($orders[$i]["order_status"]);
                                foreach ($states as $state) {
                                    ?><option <?php
                                    if ($state["selected"]) {
                                        echo "selected ";
                                    }
                                    ?>name="<?php echo $state["name"]; ?>"><?php
                                            echo $state["display_name"]
                                            ?></option><?php } ?>
                            </select>
                        </label>
                    </div>
                    <div id="status-select-wait-<?php echo $orders[$i]["order_id"]; ?>" class="status-select-wait fifth right">
                        please wait
                    </div>
                </div>
                <div class="clear"></div>
                <table class="width-100">
                    <thead>
                        <tr>
                            <td>
                                <div class="ellipsize left">Title</div>
                            </td>
                            <td>
                                <div class="ellipsize left">Option</div>
                            </td>
                            <td>
                                <div class = "ellipsize left">Quantity</div>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $last_id = $orders[$i]["order_id"];
                    }
                    ?>
                    <tr>
                        <td><div class="ellipsize left"><?php echo $orders[$i]["item_name"]; ?></div></td>
                        <td><div class="ellipsize left"><?php echo $orders[$i]["option_name"]; ?></div></td>
                        <td><div class = "ellipsize left"><?php echo $orders[$i]["quantity"]; ?></div></td>
                    </tr>
                    <?php
                    // Check next element
                    if (isset($orders[$i + 1]) && $orders[$i]["order_id"] === $orders[$i + 1]["order_id"]) {
                        continue;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    ?>
</div>