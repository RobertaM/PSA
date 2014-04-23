
<h3>
    <?php
    $show = 'Not found';

    if (isset($message))
        $show = $message;

    echo $show;
    ?>
</h3>
<?php if (isset($detailed_message)) {
    ?>
    <p>
        <?php echo $detailed_message; ?>
    </p>
    <?php
}
