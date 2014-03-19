<?php 
$this->load->helper('form');
echo form_open(base_url("products/select"));

// Print all products
foreach ($products as $item) { ?>

<div class="place-item">
	<h5 class="place-item-title">
		<?php 
		echo form_label(
		    form_checkbox(
		        Array(
		            "name" => $item['item_id'],
		            "class" => "place-item-checkbox",
		            "value" => $item['item_id']
		        )
		    ) . $item['item_name']
		); ?>
	</h5>
</div>
<?php
}	

echo form_submit(Array(
    "value"=>"Submit"
));

echo form_close();
?>
