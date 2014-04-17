
<?php
$this->load->model(Array('Cart_model', 'Place_model'));
$cart_items = $this->Cart_model->get_cart_items();

// Return if cart does not exist (Loose check)
if ($cart_items == false) {
    return;
}

$selected_place = $this->Place_model->get_selected_place();
$place_id = $selected_place['id'];
$name = 'name';
$qty = 'quantity';
?>

<div id="cart"  class="fifth left cart">
    <div class="cart-separator">
        <div class="center">
            <h4>Shopping Cart</h4>
        </div>
        <div class="center">
            <h5><?php echo $cart_items[$place_id]["name"] ?></h5>
        </div>
    </div>
    <?php foreach ($cart_items[$place_id] as $product) {
        ?>  
        <div class="cart-text">
            <?php
            // Print each attribute of a product
            if (is_array($product)) {
                foreach ($product as $option) {
                    if (is_array($option)) {
                        echo urldecode($product[$name]) . " " . urldecode($option[$name]) . " " . urldecode($option[$qty]) . '<br>';
                    }
                }
            }
            ?>
        </div>

    <?php } ?>
    <input type="submit" value="Submit" class="btn">
</div>