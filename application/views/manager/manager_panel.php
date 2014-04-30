<div>
    <?php
    $buttons = array(
        array(
            "title" => "Administrate users",
            "url" => "user/administrate"
        ),
        array(
            "title" => "Create manager",
            "url" => "user/register/manager"
        ),
        array(
            "title" => "Create worker",
            "url" => "user/register/worker"
        ),
        array(
            "title" => "Create user",
            "url" => "user/register/user"
        )
    );
    foreach ($buttons as $item) {
        ?><a class="btn" href="<?php echo base_url($item["url"]); ?>"><?php echo $item["title"]; ?></a>
    <?php }
    ?>
</div>