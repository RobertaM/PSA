<html>
<head>
<title>My Form</title>
</head>
<body>


<h3>Log in</h3>
<div class="fourfifth right">
    <?php
    echo form_open('user/login', 'class="threequarters"');
    ?>
    <ul class="blank-list-style">
        <li class="make-little-space">
            <h5>Username</h5>
            <input type="text" name="username" value="" class="login-input-size left">
            <?php echo form_error('username'); ?>
            <div class="clear"></div>
        </li>
        <li class="make-little-space">
            <h5>Password</h5>
            <input type="password" name="password" value="" class="login-input-size left">
            <?php echo form_error('password'); ?>
            <div class="clear"></div>
        </li>
    </ul>
    <input type="submit" value="Submit" class="btn">
    <?php
    form_close();
    ?>
</div>


</form>

</body>
</html>
