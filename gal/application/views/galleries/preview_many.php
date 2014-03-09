<?php
foreach ($galleries as $item) {
    ?>
    <div class="make-some-space">
        <div class="make-little-space"></div>
        <a class="header-link" href="<?php echo base_url('galleries/view/' . $item['gal_id']) ?>">
            <h3  class="gall-preview-heading"><?php echo $item['gal_name'] ?></h3>
        </a>
        <p class='gall-preview-info small'><?php
            echo $item['gal_created'];
            ?>
            Publisher:
            <a href = '<?php echo base_url('users/view/' . $item['nick']) ?>'>
                <?php echo $item['nick'];
                ?>
            </a>
        </p>
        <div class="clear">
            <p class="gall-preview-desc">
                <?php
                echo $item['gal_desc'];
                ?>
            </p>
        </div>
        <?php
        if (!$item['pic_name'] === FALSE) {
            ?>
            <div class="block-center">
                <div class="gall-preview-hover clear block-center">
                    <a href = "<?php echo base_url('galleries/view/' . $item['gal_id']) ?>">
                        <img class = "gall-preview-img" src = "<?php echo $item['pic_url']; ?>">
                    </a>
                    <div class="clear"></div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
<div id="ajax-more-gall-click" onclick="moreGalleries(<?php
echo (sizeof($galleries) + $offset);
?>)">
    <div class="left">
        <div id="ajax-more-gall-info">more galleries</div>
        <img id="ajax-more-gall-load" src="http://www.lem.hostfree.lt/GsNJNwuI-UM.gif">
    </div>
    <div class="clear"></div>
</div>