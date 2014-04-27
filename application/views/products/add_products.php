<?php echo form_open('products/add_product');
?>

<h5>Item name:</h5>
        <input type="text" name="item_name" value="<?php echo set_value('item_name'); ?>" size="50" />
        <br>

<form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">
    <label>Upload Image File:</label><br/>
    <input name="item_image" value="<?php echo set_value('item_image'); ?>" type="file" class="inputFile" />
    
    <br><br>
<div><input type="submit" value="Submit" class="btn" /></div>

    <br><br>
    <?php echo validation_errors(); ?>