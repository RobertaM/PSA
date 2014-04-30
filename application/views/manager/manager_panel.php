<div>
    <?php
    $buttons = array(
        array(
            "title" => "Administrate users",
            "url" => "user/administrate"
        )
    );
    foreach ($buttons as $item) {
        ?><a class="btn" href="<?php echo base_url($item["url"]); ?>"><?php echo $item["title"]; ?></a>
    <?php }
    ?>
</div>