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
		            "name" => $p['product_id'],
		            "class" => "place-item-checkbox",
		            "value" => $p['product_id']
		            //"checked" => $products['checked']
		        )
		    ) . $p['product_name']
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