<html>
<head>
<title>My Form</title>
</head>
<body>

<?php echo form_open('user/register'); ?>

<h5>Name</h5>
<input type="text" name="name" value="" size="50" />

<h5>Surname</h5>
<input type="text" name="surname" value="" size="50" />

<h5>Username</h5>
<input type="text" name="username" value="" size="50" />

<h5>Password</h5>
<input type="text" name="password" value="" size="50" />

<h5>Password Confirm</h5>
<input type="text" name="passconf" value="" size="50" />

<h5>Phone Number</h5>
<input type="text" name="phone_number" value="" size="50" />
<div> </div>
<div><input type="submit" value="Submit" class="btn" /></div>


</body>
</html>

