<?php $this->load->helper('url');
 	echo form_open('restaurant/addRestaurant/'.$restaurant[0]['place_id']);?>


    <h5>Restaurant name</h5>
		<input type="text" name="name" value="<?php echo $restaurant[0]['name'] ?>" size="50" />		
		<br><br>
	<h5>Restaurant description</h5>
		<input type="text" name="description" value="<?php echo $restaurant[0]['description']; ?>" size="50" />
		<br><br>
	<h5>Restaurant address</h5>
		<input type="text" name="adress" value="<?php echo $restaurant[0]['adress']; ?>" size="50" />
	<br><br>
	
	<div><input type="submit" value="Submit" class="btn" /></div>

<?php echo validation_errors(); ?>
<?php echo form_close(); ?>
	