<?php
$last_index = '';
for ($i = 0; $i < sizeof($galleries); $i++) {
    ?>
    <div class="make-some-space">
        <a class="header-link" href="<?php echo base_url('galleries/view/' . $galleries[$i]['gal_id']) ?>">
            <h3  class="gall-preview-heading"><?php echo $galleries[$i]['gal_name'] ?></h3>
        </a>
        <p class='gall-preview-info small'><?php echo $galleries[$i]['gal_created'] ?></p>
        <div class="clear">
            <p class="gall-preview-desc">
                <?php
                echo $galleries[$i]['gal_desc'];
                ?>
            </p>
        </div>
        <?php
        $old_id = $galleries[$i]['gal_id'];
        ?>
        <div class="block-center">
            <div class="gall-preview-hover clear block-center"><?php
                $one_img = true;
                while ($i < sizeof($galleries) && $galleries[$i]['gal_id'] == $old_id) {
                    if ($one_img) {
                        $one_img = false;
                        ?>
                        <a href="<?php echo base_url('galleries/view/' . $galleries[$i]['gal_id']) ?>">
                            <img class="gall-preview-img" src="<?php echo $galleries[$i]['pic_url']; ?>">
                        </a><?php
                    }
                    $i++;
                }
                $i--;
                ?>
                <div class="clear"></div>
            </div>
        </div>
        <?php
        ?>
    </div><?php
}
?>