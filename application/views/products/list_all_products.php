<?php
$this->load->helper('form');
//echo form_open(base_url("products/select"));
// Print all products and add cart buttons to each selection
$products_length = count($products);
$prev_id = null;
$curr_id = null;
for ($i = 0; $i < $products_length; $i++) {
    $curr_id = $products[$i]["item_id"];
    $print_title = !isset($prev_id) || ($prev_id !== $curr_id);

    // True if new product is being iterated trough
    if ($print_title) {
        ?>
        <div class="place-item">
            <div class="place-item-data left half">
                <h5 class="place-item-title">
                    <?php echo $products[$i]["item_name"]; ?>
                </h5>
                <div class="place-item-add-ident">
                    <?php
                    echo "Add to cart: ";

                    // Save last id for next iteration. it is no longer needed
                    $prev_id = $curr_id;
                }

                // Print add to cart button for each element
                echo form_button(Array(
                    "content" => $products[$i]["option_name"], //." ".$products[$i]["option_name"],
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

//        echo "<br />";        
                // True if product ended (class = place-item)
                if (!isset($products[$i + 1]) ||
                        (isset($products[$i + 1]) && ($products[$i + 1]["item_id"] !== $curr_id))) {
                    ?>
                </div>
            </div>
            <dd class="left half">
                <img width='290' height='290' src="data:image/jpeg;base64,<?php echo base64_encode($products[$i]["image"]) ?>">
            </dd>
        </div>
        <?php
    }
}
?>