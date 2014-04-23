<?php
$products_length = count($products);
$prev_id = null;
$curr_id = null;
 for ($i = 0; $i < $products_length; $i++) {
    $curr_id =[$i];

    // True if new product is being iterated trough
    if (!isset($prev_id) || ($prev_id !== $curr_id)) {
        ?>
        <?php  echo "<br />"; ?>
        <div class="place-item">
            <h5 class="place-item-title">
                <?php echo $products[$i]["item_name"]; ?>
            </h5>
            <?php echo "Order number: ".$products[$i]["order_id"]. "<br />Status: ".$products[$i]["order_status"].'<br /> Quantity: '.$products[$i]["quantity"].'<br /> Worker: '.$products[$i]["name"]." ".$products[$i]["surname"].'<br /> Date received: '.$products[$i]["date_received"].'<br /> User Name and Surname: '.$products[$i]["name"].' '.$products[$i]["surname"].'<br /> User telephone number: '.$products[$i]['phone_number']
                    
                    ;?>
        

       <?php echo "<br />"; 
    }
}
?>