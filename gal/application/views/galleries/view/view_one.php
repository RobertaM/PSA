<div class="make-some-space">

    <?php
    $owner = $gallery['info'][0]['user_id'] === $this->session->userdata('user_id');
    $admin = strtolower($this->session->userdata('member_class_preview')) === 'admin' &&
            $gallery['info'][0]['is_published'];
    if ($owner || $admin) {
        ?>
        <div id="editor-toolbar" class="make-little-space">
            <div class="right" id="editor-toolbar-right">
                <?php
                if ($gallery['info'][0]['user_id'] === $this->session->userdata('user_id')) {
                    ?>
                    <a href="<?php
                    echo base_url('galleries/edit/' .
                            $gallery['info'][0]['gal_id'])
                    ?>" class="decoration-hover">Edit this gallery</a>
                       <?php
                   }
                   if ($gallery['info'][0]['is_published']) {
                       ?>
                    <a href="<?php
                    echo base_url('galleries/unpublish/' .
                            $gallery['info'][0]['gal_id'])
                    ?>" class="decoration-hover">Unpublish</a>
                   <?php } else { ?>
                    <a href="<?php
                    echo base_url('galleries/publish/' .
                            $gallery['info'][0]['gal_id'])
                    ?>" class="decoration-hover">Publish</a>
                   <?php } ?>
            </div>
        </div>
        <?php
        ?>
        <div class="clear"></div>
    <?php } else { ?>
        <div class="make-little-space"></div>
    <?php } ?>
    <h3><?php echo htmlspecialchars($gallery['info'][0]['gal_name']); ?></h3>
    <p class='gall-preview-info small'>
        <?php echo $gallery['info'][0]['date_created'] ?>
        Publisher: 
        <a href='<?php echo base_url('users/view/' . $gallery['info'][0]['nick']) ?>'>
            <?php echo htmlspecialchars($gallery['info'][0]['nick']); ?>
        </a>
    </p>
    <div class="clear">
        <p class="gall-preview-desc">
            <?php
            echo htmlspecialchars($gallery['info'][0]['gal_desc']);
            ?>
        </p>
    </div>
    <div class="block-center">
        <?php
        foreach ($gallery['img'] as $item) {
            ?>
            <div class="gall-preview-hover clear block-center make-little-space">
                <img class="gall-preview-img " src="<?php echo htmlspecialchars($item['pic_url']); ?>">
                <?php
                if (!$item['pic_desc'] == '') {
                    ?>
                    <p class="gall-img-preview-desc make-little-space clear">
                        <?php
                        echo htmlspecialchars($item['pic_desc']);
                        ?>
                    </p>
                    <?php
                } else {
                    ?>
                    <?php
                }
                ?>

            </div>
            <?php
        }
        ?>
        <div class="clear"></div>
    </div>
</div>