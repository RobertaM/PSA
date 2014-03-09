
<ul class='blank-list-style'>

    <?php
    $thumb_path = '/img/gal/t/';
    foreach ($galleries as $item) {
        $images_exist = FALSE;  // tikrinama, ar iš viso egzistuoja paveikslėliai
        ?>
        <li class="clear">
            <h3><?php echo $item['name'] ?></h3>
            <div class="marg-auto max-preview-dim">
                <?php
                for ($i = 0; $i < count($item['images']); $i++) {
                    if (preg_match('(jpg$)', $item['images'][$i])) {
                        $images_exist = TRUE;
                        echo '<img class="fast-img-preview" src="' . base_url(
                                $thumb_path .
                                $item['gal_id'] .
                                '/' .
                                $item['images'][$i]
                        ) .
                        '">';
                    }
                }
                if (!$images_exist) {
                    ?>
                        <p class='text-centered'>
                            <?php
                            echo 'No images uploaded';
                            ?>
                        </p>
                    <?php
                }
                ?>
            </div>
        </li>
        <?php
    }
    ?>
</ul>
