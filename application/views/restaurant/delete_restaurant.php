
	<h3>Restaurants</h3><table class="width-100">
	<tbody>
<?php foreach($restaurant as $res): ?>
	<tr>
	   <td> <?php echo $res['name'];?></td>
	   <td><a href="<?php echo base_url('restaurant/addRestaurant/'.$res['place_id'])?>" class="edit right"> edit </a> </td>
	   <td><a href="<?php echo base_url('restaurant/deleteRestaurant/'.$res['place_id'])?>" class="delete right"> delete </a> </td>
    </tr>
<?php endforeach ?>
</tbody>
</table>
