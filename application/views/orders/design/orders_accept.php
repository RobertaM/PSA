<h3>La accept orders design</h3>
<div id="all-orders">
    <?php for ($i = 0; $i < 3; $i++) { ?>
        <div class="place-item btn btn-active btn-full btn-square">
            <div class="">
                <div class="sixth left ellipsize"><?php echo "2014-13-56 15:26" ?></div>
                <div class="twothird left ellipsize">Order summary Order summary</div>
                <div class="sixth order-status-select right">
                    <select class="btn btn-small btn-square btn-full">
                        <option>test0</option>
                        <option>test1</option>
                        <option>test2</option>
                        <option>test3</option>
                    </select>
                </div>
            </div>
            <div class="clear"></div>
            <table class="width-100 ">
                <tbody>
                    <tr>
                        <td>
                            <div class="ellipsize left">Kietas patiekalas</div>
                        </td>
                        <td>
                            <div class="ellipsize left">Didelė porcija</div>
                        </td>
                        <td>
                            <div class="ellipsize left">5 vnt</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ellipsize left">Kietas patiekalas</div>
                        </td>
                        <td>
                            <div class="ellipsize left">Didelė porcija</div>
                        </td>
                        <td>
                            <div class="ellipsize left">5 vnt</div>
                        </td>
                    </tr>
                <tbody>
            </table>
        </div>
    <?php } ?>
</div>