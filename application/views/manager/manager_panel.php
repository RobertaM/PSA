<h3><?php echo $title; ?></h3>
<div>
    <?php
    $buttons = array(
        array(
            "title" => "Edit information",
            array(
                "title" => "Administrate users roles",
                "url" => "user/administrate"
            ),
            array(
                "title" => "Edit users information",
                "url" => "user/manage_users"
            ),
            array(
                "title" => "Add restaurants",
                "url" => "restaurant/addRestaurant"
            ),
            array(
                "title" => "Manage restaurants",
                "url" => "restaurant/manageRestaurants"
            ),
            array(
                "title" => "Add product",
                "url" => "products/add"
            )
        ),
        array(
            "title" => "Create users",
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
        )
    );
    foreach ($buttons as $item) {
        ?><div class="half"><?php
        foreach ($item as $link) {
            if (is_string($link)) {
                ?><h5><?php
                echo $link;
                ?></h5><?php
                continue;
            }
            ?><div class="make-little-space">
                    <a class="btn" href="<?php echo base_url($link["url"]); ?>"><?php echo $link["title"]; ?></a>
                </div><?php
            }
            ?></div><?php
    }
    ?>
</div>