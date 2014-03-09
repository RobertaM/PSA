<?php
echo form_open(base_url('galleries/create'));
?>
<h3>Create a new gallery</h3>
<ul class="blank-list-style">
    <li class="make-little-space">
        <h5>Gallery title</h5>
        <textarea type="text" name="gall-title" class="textarea-title left"></textarea>
        <?php echo validation_errors(); ?>
        <div class="clear"></div>
    </li>
    <li class="make-little-space">
        <h5>Text</h5>
        <textarea name="text" class="textarea-text left"></textarea>
        <div class="clear"></div>
    </li>
    <li class="make-little-space">
        <input type="checkbox" name="publish" class="edit-checkbox left" value="true">publish after submit
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