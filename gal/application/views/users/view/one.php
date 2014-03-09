
<h3>
    <?php
    echo 'User ' . $user[0]['nick'];
    ?>
</h3>
<div>
    <?php
    if (!$galleries === FALSE) {
        ?>
        <h5>
            Latest galleries:
        </h5>
        <ul class="blank-list-style" id="user-gallery-list">
            <?php
            foreach ($galleries as $item) {
                ?> 
                <li>
                    <a class="decoration-hover <?php
                       if ($item['is_published'] == FALSE) {
                           echo 'unpublished';
                       }
                       ?>" 
                       href="<?php echo base_url('galleries/view/' . $item['gal_id']) ?>">
                           <?php echo $item['name'] ?>
                    </a>
                </li>
                <?php
            }
            ?> 
        </ul><?php
    } else {
        ?> 
        <h5>
            <?php
            echo 'This user has no galleries';
            ?> 
        </h5>
        <?php
    }
    ?>
</div>