<?php
$user_classes = $this->User_model->get_user_classes();
$users = $this->User_model->get_all_users();
$current_user_id = $this->User_model->get_user_data()["user_id"];
?>
<table class="width-100">
    <thead>
        <tr>
            <td>User's id</td>
            <td>Nickname</td>
            <td>Role</td>
            <td>Place (Only if worker)</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td>
                    <?php echo $user["user_id"]; ?>
                </td>
                <td>
                    <?php echo $user["username"]; ?>
                </td>
                <td>
                    <?php if ($user["user_id"] !== $current_user_id) {
                        ?>
                        <select onchange="onUserStatusChange(this)">
                            <?php
                            foreach ($user_classes as $class) {
                                ?>
                                <option <?php
                                if ($class["system_name"] === $user["role"]) {
                                    echo " selected";
                                }
                                echo ' name="' . $user["user_id"] . '/' . $class["system_name"] . '"';
                                ?>>
                                        <?php echo $class["display_name"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                </td>
                <td>
                    <?php
                    $classes = " class=\"hidden\"";
                    if ($user["role"] === "worker") {
                        $classes = "";
                    }
                    ?>
                    <select<?php echo $classes ?> onchange="onWorkerPlaceChange(this, <?php echo $user["user_id"]; ?>)">
                        <?php
                        foreach ($places as $place) {
                            ?><option name="<?php echo $place["place_id"]; ?>"<?php
                            if ($place["place_id"] === $user["place_id"]) {
                                echo " selected";
                            }
                            ?>><?php
                                        echo $place["name"] . " (" . $place["adress"] . ")";
                                        ?></option><?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
