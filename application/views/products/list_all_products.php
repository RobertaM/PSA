<?php
$this->load->helper('form');
//echo form_open(base_url("products/select"));
// Print all products and add cart buttons to each selection
$products_length = count($products);
$prev_id = null;
$curr_id = null;
for ($i = 0; $i < $products_length; $i++) {
    $curr_id = $products[$i]["item_id"];

    // True if new product is being iterated trough
    if (!isset($prev_id) || ($prev_id !== $curr_id)) {
        ?>
        <div class="place-item">
            <h5 class="place-item-title">
                <?php echo $products[$i]["item_name"] . "<br>"; ?>
            </h5><?php
            echo "Add to cart: ";

            // Save last id for next iteration. it is no longer needed
            $prev_id = $curr_id;
        }

        // Print add to cart button for each element
        echo form_button(Array(
            "content" => $products[$i]["option_name"],
            "onClick" => "addToCart('" .
            $products[$i]["item_id"] . "/" .
            $products[$i]["option_id"] . "/" .
            rawurlencode($products[$i]["item_name"]) . "/" .
            rawurlencode($products[$i]["option_name"]) . "/" .
            "')",
            // CSS 
            "class" => "btn place-item-add-button",
            // This id is used to update cart html view
            "id" => "item" .
            $products[$i]["place_id"] . "-" .
            $products[$i]["item_id"] . "-" .
            $products[$i]["option_id"]
        ));

        // True if product ended (class = place-item)
        if (!isset($products[$i + 1]) ||
                (isset($products[$i + 1]) && ($products[$i + 1]["item_id"] !== $curr_id))) {
            ?></div><?php
    }
}
?>