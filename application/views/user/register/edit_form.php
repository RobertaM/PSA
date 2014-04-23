<?php echo form_open('user/edit_user/'.$id);
var_dump($user);
?>
	
	<h5>Name</h5>
		<input type="text" name="name" value="<?php echo $user[0]['name']?>" size="50" />

	<h5>Surname</h5>
		<input type="text" name="surname" value="<?php echo $user[0]['surname'];?>" size="50" />

	<h5>Username</h5>
		<input type="text" name="username" value="<?php echo $user[0]['username'];?>" size="50" />

	<h5>Password</h5>
		<input type="password" name="password" value="<?php echo $user[0]['password'];?>" size="50" />

	<h5>Password Confirm</h5>
		<input type="password" name="passconf" value="<?php echo $user[0]['password'];?>" size="50" />

	<h5>Phone Number</h5>
		<input type="text" name="phone_number" value="<?php echo $user[0]['phone_number'];?>" size="50" />
	
	<br><br>
		
	<div><input type="submit" value="Submit" class="btn" /></div>

	<br><br>
<?php echo validation_errors(); ?>

