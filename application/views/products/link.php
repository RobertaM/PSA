<?php echo form_open('products/link');
?>

<h5>Item name:</h5>
        <input type="text" name="item_name" value="<?php echo set_value('item_name'); ?>" size="50" />
        <br>
        <br>
        <h5>Path to image:</h5>
      <input name="item_image" value="<?php echo set_value('item_image'); ?>" type="text" size="100" />
    <br><br>
    <h5>Category:</h5>
    
    
     <select id="cat" name="cat" >
      <?php
      $products_length = count($producs);
$prev_id = null;
$curr_id = null;
for ($i = 0; $i < $products_length; $i++) {
    $curr_id = $products[$i]["cat_id"];
    $print_title = !isset($prev_id) || ($prev_id !== $curr_id);
      if ($print_title) { ?>

    <option value="<?php echo $products[$i]["product_id"];?>"><?php echo $products[$i]["cat_name"] ;?></option>
<?php
      
}}
        ?></select>
    <br><br>
<div><input type="submit" value="Submit" class="btn" /></div>

    <br><br>
    <?php echo validation_errors(); ?>