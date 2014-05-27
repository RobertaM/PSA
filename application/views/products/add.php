<?php echo form_open('products/add');
?>

<h5>Item name:</h5>
        <input type="text" name="item_name" value="<?php echo set_value('item_name'); ?>" size="50" />
        <br>
        <br>
        <h5>Path to image:</h5>
      <input name="item_image" value="<?php echo set_value('item_image'); ?>" type="text" size="100" />
    <br><br>
    <h5>Category:</h5>
    If creating new category: <input name="new_category" value="<?php echo set_value('new_category'); ?>" type="text" size="20" />
    <br><br>
    If selecting existing category: 
     <select id="cat" name="cat" >
      <?php
      $products_length = count($categories);
$prev_id = null;
$curr_id = null;
for ($i = 0; $i < $products_length; $i++) {
    $curr_id = $categories[$i]["cat_id"];
    $print_title = !isset($prev_id) || ($prev_id !== $curr_id);
      if ($print_title) { ?>

    <option value="<?php echo $categories[$i]["cat_id"];?>"><?php echo $categories[$i]["cat_name"] ;?></option>
<?php
      
}}
        ?></select>
    <br><br><table class="width-33"><tbody><tr>
                <td><h5>Option #1:</h5></td>
            <td>Option name: <input type="text" name="option_name1" value="<?php echo set_value('option_name1'); ?>" size="20" /></td>
        
        <td>Option price:  <input type="text" name="price1" value="<?php echo set_value('price1'); ?>" size="20" /></td>
    </tr><tr>
        <td><h5>Option #2:</h5></td>
        <td>Option name: <input type="text" name="option_name2" value="<?php echo set_value('option_name2'); ?>" size="20" /></td>
        
        <td>Option price:  <input type="text" name="price2" value="<?php echo set_value('price2'); ?>" size="20" /></td>
    </tr><tr>
        <td><h5>Option #3:</h5></td>
        <td>Option name: <input type="text" name="option_name3" value="<?php echo set_value('option_name3'); ?>" size="20" /></td>
        
        <td>Option price:  <input type="text" name="price3" value="<?php echo set_value('price3'); ?>" size="20" /><td>
        </tr></table></tbody>
    <br><br>
<div><input type="submit" value="Submit" class="btn" /></div>

    <br><br>
    <?php echo validation_errors(); ?>