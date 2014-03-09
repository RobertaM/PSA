<?php
echo form_open(base_url('galleries/edit' . $data[0]['gal_id']));
?>
<h3>Edit gallery</h3>
<ul class="blank-list-style">
    <li class="make-little-space">
        <h5>Gallery title</h5>
        <textarea type="text" name="gall-title" class="textarea-title left"><?php echo $data[0]['gal_name']; ?></textarea>
        <?php echo validation_errors(); ?>
        <div class="clear"></div>
    </li>
    <li class="make-little-space">
        <h5>Text</h5>
        <textarea name="text" class="textarea-text left"><?php echo $data[0]['gal_desc'] ?></textarea>
        <div class="clear"></div>
    </li>
    <li>
        
        
       
        
        
        
    </li>
    <li class="make-little-space">
        <input type="checkbox" name="publish" class="edit-checkbox" value="true" <?php
        if ($data[0]['is_published']) {
            echo 'checked';
        }
        ?>>publish after submit
        <div class="clear"></div>
    </li>
    <li class="make-little-space">
        <input type="submit" class="btn">
        <div class="clear"></div>
    </li>
</ul>
<?php
echo form_close();
?>