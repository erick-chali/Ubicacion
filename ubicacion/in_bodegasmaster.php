<?php

// codigo_bodega
// descripcion

?>
<?php if ($in_bodegas->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $in_bodegas->TableCaption() ?></h4> -->
<table id="tbl_in_bodegasmaster" class="table table-bordered table-striped ewViewTable">
	<tbody>
<?php if ($in_bodegas->codigo_bodega->Visible) { // codigo_bodega ?>
		<tr id="r_codigo_bodega">
			<td><?php echo $in_bodegas->codigo_bodega->FldCaption() ?></td>
			<td<?php echo $in_bodegas->codigo_bodega->CellAttributes() ?>>
<span id="el_in_bodegas_codigo_bodega">
<span<?php echo $in_bodegas->codigo_bodega->ViewAttributes() ?>>
<?php echo $in_bodegas->codigo_bodega->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($in_bodegas->descripcion->Visible) { // descripcion ?>
		<tr id="r_descripcion">
			<td><?php echo $in_bodegas->descripcion->FldCaption() ?></td>
			<td<?php echo $in_bodegas->descripcion->CellAttributes() ?>>
<span id="el_in_bodegas_descripcion">
<span<?php echo $in_bodegas->descripcion->ViewAttributes() ?>>
<?php echo $in_bodegas->descripcion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
