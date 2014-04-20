<?php 
	//$this->load->helper('url');

    foreach($restaurant as $res): ?>
	   <a href="<?php echo base_url('restaurant/deleteRestaurant/'.$res['place_id'])?>" class="delete"> delete </a>
       <?php echo $res['name'];?>
       <br>
    <?php endforeach ?>

