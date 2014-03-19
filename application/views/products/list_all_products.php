<?php 

$this->load->helper('form');

echo form_open(base_url("products/select"));

// Print all places
foreach ($products as $p) { ?>

<div class="place-item">
	<h5 class="place-item-title">
		<?php 
		echo form_label(
		    form_checkbox(
		        Array(
		            "name" => $p['item_id'],
		            "class" => "place-item-checkbox",
		            "value" => $p['item_id']
		            //"checked" => $products['checked']
		        )
		    ) . $p['item_name']
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