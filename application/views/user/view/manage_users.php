<?php
    foreach($users as $us): ?>
	   <a href="<?php echo base_url('user/edit_user/'.$us['user_id'])?>" class="edit right"> edit </a>
	   <a href="<?php echo base_url('user/delete_user/'.$us['user_id'])?>" class="delete right"> delete &nbsp </a>
       <?php echo $us['name']," ", $us['role'];?>
       <br>
    <?php endforeach 
?>
