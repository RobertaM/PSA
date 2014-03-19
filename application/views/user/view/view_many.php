
<ul>
    <?php
    foreach ($users as $item) {
        ?>
        <li>
            <a href="<?php echo base_url('user/view/' . $item['nick']) ?>"><?php echo $item['nick']; ?></a>
        </li>
        <?php
    }
    ?>
</ul>