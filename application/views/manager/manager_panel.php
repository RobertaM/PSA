<div>
    <?php
    $buttons = array(
        array(
            "title" => "Administrate users",
            "url" => "user/administrate"
        ),
        array(
            "title" => "Manage restaurants",
            "url" => "restaurant/manageRestaurants"
        ),
        array(
            "title" => "Manage orders",
            "url" => "places/select"
        ),
        array(
            "type" => "separator"
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
    ?><div><?php
        foreach ($buttons as $item) {
            if (!isset($item["type"]) || $item["type"] != "separator") {
                ?><a class="btn" href="<?php echo base_url($item["url"]); ?>"><?php echo $item["title"]; ?></a>
                <?php
            } else {
                ?></div>
            <div><?php
            }
        }
        ?>
    </div>
</div>