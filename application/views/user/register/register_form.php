<?php echo form_open('user/register/'.$id);
var_dump($user);
?>
	
	<h5>Name</h5>
		<input type="text" name="name" value="<?php echo set_value('name');?>" size="50" />

	<h5>Surname</h5>
		<input type="text" name="surname" value="<?php echo set_value('surname');?>" size="50" />

	<h5>Username</h5>
		<input type="text" name="username" value="<?php echo set_value('username');?>" size="50" />

	<h5>Password</h5>
		<input type="text" name="password" value="<?php echo set_value('password');?>" size="50" />

	<h5>Password Confirm</h5>
		<input type="text" name="passconf" value="<?php echo set_value('passconf');?>" size="50" />

	<h5>Phone Number</h5>
		<input type="text" name="phone_number" value="<?php echo set_value('phone_number');?>" size="50" />
	
	<br><br>
		
	<div><input type="submit" value="Submit" class="btn" /></div>

	<br><br>
<?php echo validation_errors(); ?>

