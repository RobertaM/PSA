<?php
$products_length = count($products);
$prev_id = null;
$curr_id = null;
for ($i = 0; $i < $products_length; $i++) {
    $curr_id = $products[$i]["item_id"];

    // True if new product is being iterated trough
    if (!isset($prev_id) || ($prev_id !== $curr_id)) {
        ?>
        <?php  echo "<br />"; ?>
        <div class="place-item">
            <h5 class="place-item-title">
                <?php echo $products[$i]["item_name"]; ?>
            </h5>
            <?php echo "Status: ".$products[$i]["status"].'<br /> Quantity: '.$products[$i]["quantity"].'<br /> Worker: '.$products[$i]["worker_id"].'<br /> Date updated: '.$products[$i]["date"].'<br /> User Name and Surname: '.$products[$i]["name"].' '.$products[$i]["surname"].'<br /> User telephone number: '.$products[$i]['phone_number']
                    
                    ;?>
        

       <?php echo "<br />"; 
    }
}
?>