
<ul class='blank-list-style'>

    <?php
    $thumb_path = '/img/gal/t/';
    $img_path = '/img/gal/i/';
    foreach ($galleries as $item) {
        $images_exist = FALSE;  // tikrinama, ar iš viso egzistuoja paveikslėliai
        ?>
        <li class="clear">
            <a class="link-header" href="<?php echo base_url('galleries/view/' . $item['gal_id']); ?>">
                <h3>
                    <?php echo $item['name'] ?>
                </h3>
            </a>
            <div class="marg-auto max-preview-dim">
                <a href="<?php echo base_url('galleries/view/' . $item['gal_id']); ?>">
                    <div class="fast-img-preview-info">
                        <h5 class='left f-i-p-i-txt'>
                            view gallery
                        </h5>
                        <p class='right f-i-p-i-txt'>
                            <?php echo 'created: ' . $item['date_created']; ?>
                        </p>
                    </div>
                </a>
                <?php
                for ($i = 0; $i < count($item['images']) && $i < 4; $i++) {
                    if (preg_match('(jpg$)', $item['images'][$i])) {
                        $images_exist = TRUE;
                        ?>
                        <a href="<?php
                        echo base_url(
                                $img_path .
                                $item['gal_id'] . '/' .
                                $item['images'][$i])
                        ?>
                           ">
                            <img class="fast-img-preview" src="<?php
                            echo base_url(
                                    $thumb_path .
                                    $item['gal_id'] . '/' .
                                    $item['images'][$i])
                            ?>
                                 "></a>
                            <?php
                        }
                    }
                    if (!$images_exist) {
                        ?>
                    <div class='fast-img-preview-no-images'>
                        <p class='text-centered'>
                            <?php
                            echo 'No images uploaded';
                            ?>
                        </p>
                    </div>
                    <?php
                }
                ?>
                <div class="clear"></div>
            </div>
        </li>
        <?php
    }
    ?>
</ul>