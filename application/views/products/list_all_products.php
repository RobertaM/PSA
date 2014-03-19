<?php 
$this->load->helper('form');
echo form_open(base_url("products/select"));

// Print all products
foreach ($products as $p) { ?>

<div class="place-item">
	<h5 class="place-item-title">
		<?php 
               		
              echo '"',$p['item_name'],'"','; kategorija: ',$p['cat_name'],'; dydis: ',$p['option_name'],
                      '; kaina: ',$p['price'],' Lt.'
              
                
                ?>
	</h5>
</div>
<?php
}

echo form_submit(Array(
    "value"=>"Submit"
));

echo form_close();
?>
