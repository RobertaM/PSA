<?php 

$this->load->helper('form');

echo form_open(base_url("places/select"));

// Print all places
foreach ($places as $place) { ?>

<div class="place-item">
	<h5 class="place-item-title">
		<?php
		echo form_label(
		    form_radio(
		        Array(
		            "name" => "place-radio",
		            "class" => "place-item-checkbox",
		            "value" => $place['place_id'],
		            "checked" => $place['checked']
		        )
		    ) . $place['name']
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