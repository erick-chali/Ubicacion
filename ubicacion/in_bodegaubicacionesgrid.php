<?php include_once "_Usersinfo.php" ?>
<?php

// Create page object
if (!isset($in_bodegaubicaciones_grid)) $in_bodegaubicaciones_grid = new cin_bodegaubicaciones_grid();

// Page init
$in_bodegaubicaciones_grid->Page_Init();

// Page main
$in_bodegaubicaciones_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$in_bodegaubicaciones_grid->Page_Render();
?>
<?php if ($in_bodegaubicaciones->Export == "") { ?>
<script type="text/javascript">

// Page object
var in_bodegaubicaciones_grid = new ew_Page("in_bodegaubicaciones_grid");
in_bodegaubicaciones_grid.PageID = "grid"; // Page ID
var EW_PAGE_ID = in_bodegaubicaciones_grid.PageID; // For backward compatibility

// Form object
var fin_bodegaubicacionesgrid = new ew_Form("fin_bodegaubicacionesgrid");
fin_bodegaubicacionesgrid.FormKeyCountName = '<?php echo $in_bodegaubicaciones_grid->FormKeyCountName ?>';

// Validate form
fin_bodegaubicacionesgrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	this.PostAutoSuggest();
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_codigo_bodega");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $in_bodegaubicaciones->codigo_bodega->FldCaption(), $in_bodegaubicaciones->codigo_bodega->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Estanteria_Id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $in_bodegaubicaciones->Estanteria_Id->FldCaption(), $in_bodegaubicaciones->Estanteria_Id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Seccion_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $in_bodegaubicaciones->Seccion_id->FldCaption(), $in_bodegaubicaciones->Seccion_id->ReqErrMsg)) ?>");

			// Set up row object
			ew_ElementsToRow(fobj);

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fin_bodegaubicacionesgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "codigo_bodega", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Estanteria_Id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Seccion_id", false)) return false;
	return true;
}

// Form_CustomValidate event
fin_bodegaubicacionesgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fin_bodegaubicacionesgrid.ValidateRequired = true;
<?php } else { ?>
fin_bodegaubicacionesgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fin_bodegaubicacionesgrid.Lists["x_Estanteria_Id"] = {"LinkField":"x_Estanteria_Id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};
fin_bodegaubicacionesgrid.Lists["x_Seccion_id"] = {"LinkField":"x_Seccion_Id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<?php } ?>
<?php
if ($in_bodegaubicaciones->CurrentAction == "gridadd") {
	if ($in_bodegaubicaciones->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$in_bodegaubicaciones_grid->TotalRecs = $in_bodegaubicaciones->SelectRecordCount();
			$in_bodegaubicaciones_grid->Recordset = $in_bodegaubicaciones_grid->LoadRecordset($in_bodegaubicaciones_grid->StartRec-1, $in_bodegaubicaciones_grid->DisplayRecs);
		} else {
			if ($in_bodegaubicaciones_grid->Recordset = $in_bodegaubicaciones_grid->LoadRecordset())
				$in_bodegaubicaciones_grid->TotalRecs = $in_bodegaubicaciones_grid->Recordset->RecordCount();
		}
		$in_bodegaubicaciones_grid->StartRec = 1;
		$in_bodegaubicaciones_grid->DisplayRecs = $in_bodegaubicaciones_grid->TotalRecs;
	} else {
		$in_bodegaubicaciones->CurrentFilter = "0=1";
		$in_bodegaubicaciones_grid->StartRec = 1;
		$in_bodegaubicaciones_grid->DisplayRecs = $in_bodegaubicaciones->GridAddRowCount;
	}
	$in_bodegaubicaciones_grid->TotalRecs = $in_bodegaubicaciones_grid->DisplayRecs;
	$in_bodegaubicaciones_grid->StopRec = $in_bodegaubicaciones_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		if ($in_bodegaubicaciones_grid->TotalRecs <= 0)
			$in_bodegaubicaciones_grid->TotalRecs = $in_bodegaubicaciones->SelectRecordCount();
	} else {
		if (!$in_bodegaubicaciones_grid->Recordset && ($in_bodegaubicaciones_grid->Recordset = $in_bodegaubicaciones_grid->LoadRecordset()))
			$in_bodegaubicaciones_grid->TotalRecs = $in_bodegaubicaciones_grid->Recordset->RecordCount();
	}
	$in_bodegaubicaciones_grid->StartRec = 1;
	$in_bodegaubicaciones_grid->DisplayRecs = $in_bodegaubicaciones_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$in_bodegaubicaciones_grid->Recordset = $in_bodegaubicaciones_grid->LoadRecordset($in_bodegaubicaciones_grid->StartRec-1, $in_bodegaubicaciones_grid->DisplayRecs);

	// Set no record found message
	if ($in_bodegaubicaciones->CurrentAction == "" && $in_bodegaubicaciones_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$in_bodegaubicaciones_grid->setWarningMessage($Language->Phrase("NoPermission"));
		if ($in_bodegaubicaciones_grid->SearchWhere == "0=101")
			$in_bodegaubicaciones_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$in_bodegaubicaciones_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$in_bodegaubicaciones_grid->RenderOtherOptions();
?>
<?php $in_bodegaubicaciones_grid->ShowPageHeader(); ?>
<?php
$in_bodegaubicaciones_grid->ShowMessage();
?>
<?php if ($in_bodegaubicaciones_grid->TotalRecs > 0 || $in_bodegaubicaciones->CurrentAction <> "") { ?>
<div class="ewGrid">
<div id="fin_bodegaubicacionesgrid" class="ewForm form-inline">
<?php if ($in_bodegaubicaciones_grid->ShowOtherOptions) { ?>
<div class="ewGridUpperPanel">
<?php
	foreach ($in_bodegaubicaciones_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_in_bodegaubicaciones" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_in_bodegaubicacionesgrid" class="table ewTable">
<?php echo $in_bodegaubicaciones->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$in_bodegaubicaciones->RowType = EW_ROWTYPE_HEADER;

// Render list options
$in_bodegaubicaciones_grid->RenderListOptions();

// Render list options (header, left)
$in_bodegaubicaciones_grid->ListOptions->Render("header", "left");
?>
<?php if ($in_bodegaubicaciones->codigo_bodega->Visible) { // codigo_bodega ?>
	<?php if ($in_bodegaubicaciones->SortUrl($in_bodegaubicaciones->codigo_bodega) == "") { ?>
		<th data-name="codigo_bodega"><div id="elh_in_bodegaubicaciones_codigo_bodega" class="in_bodegaubicaciones_codigo_bodega"><div class="ewTableHeaderCaption"><?php echo $in_bodegaubicaciones->codigo_bodega->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigo_bodega"><div><div id="elh_in_bodegaubicaciones_codigo_bodega" class="in_bodegaubicaciones_codigo_bodega">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $in_bodegaubicaciones->codigo_bodega->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($in_bodegaubicaciones->codigo_bodega->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($in_bodegaubicaciones->codigo_bodega->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($in_bodegaubicaciones->Estanteria_Id->Visible) { // Estanteria_Id ?>
	<?php if ($in_bodegaubicaciones->SortUrl($in_bodegaubicaciones->Estanteria_Id) == "") { ?>
		<th data-name="Estanteria_Id"><div id="elh_in_bodegaubicaciones_Estanteria_Id" class="in_bodegaubicaciones_Estanteria_Id"><div class="ewTableHeaderCaption"><?php echo $in_bodegaubicaciones->Estanteria_Id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Estanteria_Id"><div><div id="elh_in_bodegaubicaciones_Estanteria_Id" class="in_bodegaubicaciones_Estanteria_Id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $in_bodegaubicaciones->Estanteria_Id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($in_bodegaubicaciones->Estanteria_Id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($in_bodegaubicaciones->Estanteria_Id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($in_bodegaubicaciones->Seccion_id->Visible) { // Seccion_id ?>
	<?php if ($in_bodegaubicaciones->SortUrl($in_bodegaubicaciones->Seccion_id) == "") { ?>
		<th data-name="Seccion_id"><div id="elh_in_bodegaubicaciones_Seccion_id" class="in_bodegaubicaciones_Seccion_id"><div class="ewTableHeaderCaption"><?php echo $in_bodegaubicaciones->Seccion_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Seccion_id"><div><div id="elh_in_bodegaubicaciones_Seccion_id" class="in_bodegaubicaciones_Seccion_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $in_bodegaubicaciones->Seccion_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($in_bodegaubicaciones->Seccion_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($in_bodegaubicaciones->Seccion_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$in_bodegaubicaciones_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$in_bodegaubicaciones_grid->StartRec = 1;
$in_bodegaubicaciones_grid->StopRec = $in_bodegaubicaciones_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($in_bodegaubicaciones_grid->FormKeyCountName) && ($in_bodegaubicaciones->CurrentAction == "gridadd" || $in_bodegaubicaciones->CurrentAction == "gridedit" || $in_bodegaubicaciones->CurrentAction == "F")) {
		$in_bodegaubicaciones_grid->KeyCount = $objForm->GetValue($in_bodegaubicaciones_grid->FormKeyCountName);
		$in_bodegaubicaciones_grid->StopRec = $in_bodegaubicaciones_grid->StartRec + $in_bodegaubicaciones_grid->KeyCount - 1;
	}
}
$in_bodegaubicaciones_grid->RecCnt = $in_bodegaubicaciones_grid->StartRec - 1;
if ($in_bodegaubicaciones_grid->Recordset && !$in_bodegaubicaciones_grid->Recordset->EOF) {
	$in_bodegaubicaciones_grid->Recordset->MoveFirst();
	$bSelectLimit = EW_SELECT_LIMIT;
	if (!$bSelectLimit && $in_bodegaubicaciones_grid->StartRec > 1)
		$in_bodegaubicaciones_grid->Recordset->Move($in_bodegaubicaciones_grid->StartRec - 1);
} elseif (!$in_bodegaubicaciones->AllowAddDeleteRow && $in_bodegaubicaciones_grid->StopRec == 0) {
	$in_bodegaubicaciones_grid->StopRec = $in_bodegaubicaciones->GridAddRowCount;
}

// Initialize aggregate
$in_bodegaubicaciones->RowType = EW_ROWTYPE_AGGREGATEINIT;
$in_bodegaubicaciones->ResetAttrs();
$in_bodegaubicaciones_grid->RenderRow();
if ($in_bodegaubicaciones->CurrentAction == "gridadd")
	$in_bodegaubicaciones_grid->RowIndex = 0;
if ($in_bodegaubicaciones->CurrentAction == "gridedit")
	$in_bodegaubicaciones_grid->RowIndex = 0;
while ($in_bodegaubicaciones_grid->RecCnt < $in_bodegaubicaciones_grid->StopRec) {
	$in_bodegaubicaciones_grid->RecCnt++;
	if (intval($in_bodegaubicaciones_grid->RecCnt) >= intval($in_bodegaubicaciones_grid->StartRec)) {
		$in_bodegaubicaciones_grid->RowCnt++;
		if ($in_bodegaubicaciones->CurrentAction == "gridadd" || $in_bodegaubicaciones->CurrentAction == "gridedit" || $in_bodegaubicaciones->CurrentAction == "F") {
			$in_bodegaubicaciones_grid->RowIndex++;
			$objForm->Index = $in_bodegaubicaciones_grid->RowIndex;
			if ($objForm->HasValue($in_bodegaubicaciones_grid->FormActionName))
				$in_bodegaubicaciones_grid->RowAction = strval($objForm->GetValue($in_bodegaubicaciones_grid->FormActionName));
			elseif ($in_bodegaubicaciones->CurrentAction == "gridadd")
				$in_bodegaubicaciones_grid->RowAction = "insert";
			else
				$in_bodegaubicaciones_grid->RowAction = "";
		}

		// Set up key count
		$in_bodegaubicaciones_grid->KeyCount = $in_bodegaubicaciones_grid->RowIndex;

		// Init row class and style
		$in_bodegaubicaciones->ResetAttrs();
		$in_bodegaubicaciones->CssClass = "";
		if ($in_bodegaubicaciones->CurrentAction == "gridadd") {
			if ($in_bodegaubicaciones->CurrentMode == "copy") {
				$in_bodegaubicaciones_grid->LoadRowValues($in_bodegaubicaciones_grid->Recordset); // Load row values
				$in_bodegaubicaciones_grid->SetRecordKey($in_bodegaubicaciones_grid->RowOldKey, $in_bodegaubicaciones_grid->Recordset); // Set old record key
			} else {
				$in_bodegaubicaciones_grid->LoadDefaultValues(); // Load default values
				$in_bodegaubicaciones_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$in_bodegaubicaciones_grid->LoadRowValues($in_bodegaubicaciones_grid->Recordset); // Load row values
		}
		$in_bodegaubicaciones->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($in_bodegaubicaciones->CurrentAction == "gridadd") // Grid add
			$in_bodegaubicaciones->RowType = EW_ROWTYPE_ADD; // Render add
		if ($in_bodegaubicaciones->CurrentAction == "gridadd" && $in_bodegaubicaciones->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$in_bodegaubicaciones_grid->RestoreCurrentRowFormValues($in_bodegaubicaciones_grid->RowIndex); // Restore form values
		if ($in_bodegaubicaciones->CurrentAction == "gridedit") { // Grid edit
			if ($in_bodegaubicaciones->EventCancelled) {
				$in_bodegaubicaciones_grid->RestoreCurrentRowFormValues($in_bodegaubicaciones_grid->RowIndex); // Restore form values
			}
			if ($in_bodegaubicaciones_grid->RowAction == "insert")
				$in_bodegaubicaciones->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$in_bodegaubicaciones->RowType = EW_ROWTYPE_EDIT; // Render edit
			if (!$in_bodegaubicaciones->EventCancelled)
				$in_bodegaubicaciones_grid->HashValue = $in_bodegaubicaciones_grid->GetRowHash($in_bodegaubicaciones_grid->Recordset); // Get hash value for record
		}
		if ($in_bodegaubicaciones->CurrentAction == "gridedit" && ($in_bodegaubicaciones->RowType == EW_ROWTYPE_EDIT || $in_bodegaubicaciones->RowType == EW_ROWTYPE_ADD) && $in_bodegaubicaciones->EventCancelled) // Update failed
			$in_bodegaubicaciones_grid->RestoreCurrentRowFormValues($in_bodegaubicaciones_grid->RowIndex); // Restore form values
		if ($in_bodegaubicaciones->RowType == EW_ROWTYPE_EDIT) // Edit row
			$in_bodegaubicaciones_grid->EditRowCnt++;
		if ($in_bodegaubicaciones->CurrentAction == "F") // Confirm row
			$in_bodegaubicaciones_grid->RestoreCurrentRowFormValues($in_bodegaubicaciones_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$in_bodegaubicaciones->RowAttrs = array_merge($in_bodegaubicaciones->RowAttrs, array('data-rowindex'=>$in_bodegaubicaciones_grid->RowCnt, 'id'=>'r' . $in_bodegaubicaciones_grid->RowCnt . '_in_bodegaubicaciones', 'data-rowtype'=>$in_bodegaubicaciones->RowType));

		// Render row
		$in_bodegaubicaciones_grid->RenderRow();

		// Render list options
		$in_bodegaubicaciones_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($in_bodegaubicaciones_grid->RowAction <> "delete" && $in_bodegaubicaciones_grid->RowAction <> "insertdelete" && !($in_bodegaubicaciones_grid->RowAction == "insert" && $in_bodegaubicaciones->CurrentAction == "F" && $in_bodegaubicaciones_grid->EmptyRow())) {
?>
	<tr<?php echo $in_bodegaubicaciones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$in_bodegaubicaciones_grid->ListOptions->Render("body", "left", $in_bodegaubicaciones_grid->RowCnt);
?>
	<?php if ($in_bodegaubicaciones->codigo_bodega->Visible) { // codigo_bodega ?>
		<td data-name="codigo_bodega"<?php echo $in_bodegaubicaciones->codigo_bodega->CellAttributes() ?>>
<?php if ($in_bodegaubicaciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($in_bodegaubicaciones->codigo_bodega->getSessionValue() <> "") { ?>
<span id="el<?php echo $in_bodegaubicaciones_grid->RowCnt ?>_in_bodegaubicaciones_codigo_bodega" class="form-group in_bodegaubicaciones_codigo_bodega">
<span<?php echo $in_bodegaubicaciones->codigo_bodega->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->codigo_bodega->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $in_bodegaubicaciones_grid->RowCnt ?>_in_bodegaubicaciones_codigo_bodega" class="form-group in_bodegaubicaciones_codigo_bodega">
<input type="text" data-field="x_codigo_bodega" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" size="30" placeholder="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->PlaceHolder) ?>" value="<?php echo $in_bodegaubicaciones->codigo_bodega->EditValue ?>"<?php echo $in_bodegaubicaciones->codigo_bodega->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-field="x_codigo_bodega" name="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" id="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->OldValue) ?>">
<?php } ?>
<?php if ($in_bodegaubicaciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $in_bodegaubicaciones_grid->RowCnt ?>_in_bodegaubicaciones_codigo_bodega" class="form-group in_bodegaubicaciones_codigo_bodega">
<span<?php echo $in_bodegaubicaciones->codigo_bodega->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->codigo_bodega->EditValue ?></p></span>
</span>
<input type="hidden" data-field="x_codigo_bodega" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->CurrentValue) ?>">
<?php } ?>
<?php if ($in_bodegaubicaciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $in_bodegaubicaciones->codigo_bodega->ViewAttributes() ?>>
<?php echo $in_bodegaubicaciones->codigo_bodega->ListViewValue() ?></span>
<input type="hidden" data-field="x_codigo_bodega" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->FormValue) ?>">
<input type="hidden" data-field="x_codigo_bodega" name="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" id="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->OldValue) ?>">
<?php } ?>
<a id="<?php echo $in_bodegaubicaciones_grid->PageObjName . "_row_" . $in_bodegaubicaciones_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($in_bodegaubicaciones->Estanteria_Id->Visible) { // Estanteria_Id ?>
		<td data-name="Estanteria_Id"<?php echo $in_bodegaubicaciones->Estanteria_Id->CellAttributes() ?>>
<?php if ($in_bodegaubicaciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $in_bodegaubicaciones_grid->RowCnt ?>_in_bodegaubicaciones_Estanteria_Id" class="form-group in_bodegaubicaciones_Estanteria_Id">
<select data-field="x_Estanteria_Id" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id"<?php echo $in_bodegaubicaciones->Estanteria_Id->EditAttributes() ?>>
<?php
if (is_array($in_bodegaubicaciones->Estanteria_Id->EditValue)) {
	$arwrk = $in_bodegaubicaciones->Estanteria_Id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($in_bodegaubicaciones->Estanteria_Id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $in_bodegaubicaciones->Estanteria_Id->OldValue = "";
?>
</select>
<?php
 $sSqlWrk = "SELECT [Estanteria_Id], [descripcion] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [dbo].[in_estanteria]";
 $sWhereWrk = "";

 // Call Lookup selecting
 $in_bodegaubicaciones->Lookup_Selecting($in_bodegaubicaciones->Estanteria_Id, $sWhereWrk);
 if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" id="s_x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&amp;f0=<?php echo ew_Encrypt("[Estanteria_Id] = {filter_value}"); ?>&amp;t0=3">
</span>
<input type="hidden" data-field="x_Estanteria_Id" name="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" id="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Estanteria_Id->OldValue) ?>">
<?php } ?>
<?php if ($in_bodegaubicaciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $in_bodegaubicaciones_grid->RowCnt ?>_in_bodegaubicaciones_Estanteria_Id" class="form-group in_bodegaubicaciones_Estanteria_Id">
<span<?php echo $in_bodegaubicaciones->Estanteria_Id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->Estanteria_Id->EditValue ?></p></span>
</span>
<input type="hidden" data-field="x_Estanteria_Id" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Estanteria_Id->CurrentValue) ?>">
<?php } ?>
<?php if ($in_bodegaubicaciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $in_bodegaubicaciones->Estanteria_Id->ViewAttributes() ?>>
<?php echo $in_bodegaubicaciones->Estanteria_Id->ListViewValue() ?></span>
<input type="hidden" data-field="x_Estanteria_Id" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Estanteria_Id->FormValue) ?>">
<input type="hidden" data-field="x_Estanteria_Id" name="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" id="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Estanteria_Id->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($in_bodegaubicaciones->Seccion_id->Visible) { // Seccion_id ?>
		<td data-name="Seccion_id"<?php echo $in_bodegaubicaciones->Seccion_id->CellAttributes() ?>>
<?php if ($in_bodegaubicaciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $in_bodegaubicaciones_grid->RowCnt ?>_in_bodegaubicaciones_Seccion_id" class="form-group in_bodegaubicaciones_Seccion_id">
<select data-field="x_Seccion_id" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id"<?php echo $in_bodegaubicaciones->Seccion_id->EditAttributes() ?>>
<?php
if (is_array($in_bodegaubicaciones->Seccion_id->EditValue)) {
	$arwrk = $in_bodegaubicaciones->Seccion_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($in_bodegaubicaciones->Seccion_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $in_bodegaubicaciones->Seccion_id->OldValue = "";
?>
</select>
<?php
 $sSqlWrk = "SELECT [Seccion_Id], [descripcion] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [dbo].[in_seccionestanteria]";
 $sWhereWrk = "";

 // Call Lookup selecting
 $in_bodegaubicaciones->Lookup_Selecting($in_bodegaubicaciones->Seccion_id, $sWhereWrk);
 if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" id="s_x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&amp;f0=<?php echo ew_Encrypt("[Seccion_Id] = {filter_value}"); ?>&amp;t0=3">
</span>
<input type="hidden" data-field="x_Seccion_id" name="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" id="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Seccion_id->OldValue) ?>">
<?php } ?>
<?php if ($in_bodegaubicaciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $in_bodegaubicaciones_grid->RowCnt ?>_in_bodegaubicaciones_Seccion_id" class="form-group in_bodegaubicaciones_Seccion_id">
<span<?php echo $in_bodegaubicaciones->Seccion_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->Seccion_id->EditValue ?></p></span>
</span>
<input type="hidden" data-field="x_Seccion_id" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Seccion_id->CurrentValue) ?>">
<?php } ?>
<?php if ($in_bodegaubicaciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $in_bodegaubicaciones->Seccion_id->ViewAttributes() ?>>
<?php echo $in_bodegaubicaciones->Seccion_id->ListViewValue() ?></span>
<input type="hidden" data-field="x_Seccion_id" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Seccion_id->FormValue) ?>">
<input type="hidden" data-field="x_Seccion_id" name="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" id="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Seccion_id->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$in_bodegaubicaciones_grid->ListOptions->Render("body", "right", $in_bodegaubicaciones_grid->RowCnt);
?>
	</tr>
<?php if ($in_bodegaubicaciones->RowType == EW_ROWTYPE_ADD || $in_bodegaubicaciones->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fin_bodegaubicacionesgrid.UpdateOpts(<?php echo $in_bodegaubicaciones_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($in_bodegaubicaciones->CurrentAction <> "gridadd" || $in_bodegaubicaciones->CurrentMode == "copy")
		if (!$in_bodegaubicaciones_grid->Recordset->EOF) $in_bodegaubicaciones_grid->Recordset->MoveNext();
}
?>
<?php
	if ($in_bodegaubicaciones->CurrentMode == "add" || $in_bodegaubicaciones->CurrentMode == "copy" || $in_bodegaubicaciones->CurrentMode == "edit") {
		$in_bodegaubicaciones_grid->RowIndex = '$rowindex$';
		$in_bodegaubicaciones_grid->LoadDefaultValues();

		// Set row properties
		$in_bodegaubicaciones->ResetAttrs();
		$in_bodegaubicaciones->RowAttrs = array_merge($in_bodegaubicaciones->RowAttrs, array('data-rowindex'=>$in_bodegaubicaciones_grid->RowIndex, 'id'=>'r0_in_bodegaubicaciones', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($in_bodegaubicaciones->RowAttrs["class"], "ewTemplate");
		$in_bodegaubicaciones->RowType = EW_ROWTYPE_ADD;

		// Render row
		$in_bodegaubicaciones_grid->RenderRow();

		// Render list options
		$in_bodegaubicaciones_grid->RenderListOptions();
		$in_bodegaubicaciones_grid->StartRowCnt = 0;
?>
	<tr<?php echo $in_bodegaubicaciones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$in_bodegaubicaciones_grid->ListOptions->Render("body", "left", $in_bodegaubicaciones_grid->RowIndex);
?>
	<?php if ($in_bodegaubicaciones->codigo_bodega->Visible) { // codigo_bodega ?>
		<td data-name="codigo_bodega">
<?php if ($in_bodegaubicaciones->CurrentAction <> "F") { ?>
<?php if ($in_bodegaubicaciones->codigo_bodega->getSessionValue() <> "") { ?>
<span id="el$rowindex$_in_bodegaubicaciones_codigo_bodega" class="form-group in_bodegaubicaciones_codigo_bodega">
<span<?php echo $in_bodegaubicaciones->codigo_bodega->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->codigo_bodega->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_in_bodegaubicaciones_codigo_bodega" class="form-group in_bodegaubicaciones_codigo_bodega">
<input type="text" data-field="x_codigo_bodega" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" size="30" placeholder="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->PlaceHolder) ?>" value="<?php echo $in_bodegaubicaciones->codigo_bodega->EditValue ?>"<?php echo $in_bodegaubicaciones->codigo_bodega->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_in_bodegaubicaciones_codigo_bodega" class="form-group in_bodegaubicaciones_codigo_bodega">
<span<?php echo $in_bodegaubicaciones->codigo_bodega->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->codigo_bodega->ViewValue ?></p></span>
</span>
<input type="hidden" data-field="x_codigo_bodega" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_codigo_bodega" name="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" id="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_codigo_bodega" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($in_bodegaubicaciones->Estanteria_Id->Visible) { // Estanteria_Id ?>
		<td data-name="Estanteria_Id">
<?php if ($in_bodegaubicaciones->CurrentAction <> "F") { ?>
<span id="el$rowindex$_in_bodegaubicaciones_Estanteria_Id" class="form-group in_bodegaubicaciones_Estanteria_Id">
<select data-field="x_Estanteria_Id" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id"<?php echo $in_bodegaubicaciones->Estanteria_Id->EditAttributes() ?>>
<?php
if (is_array($in_bodegaubicaciones->Estanteria_Id->EditValue)) {
	$arwrk = $in_bodegaubicaciones->Estanteria_Id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($in_bodegaubicaciones->Estanteria_Id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $in_bodegaubicaciones->Estanteria_Id->OldValue = "";
?>
</select>
<?php
 $sSqlWrk = "SELECT [Estanteria_Id], [descripcion] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [dbo].[in_estanteria]";
 $sWhereWrk = "";

 // Call Lookup selecting
 $in_bodegaubicaciones->Lookup_Selecting($in_bodegaubicaciones->Estanteria_Id, $sWhereWrk);
 if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" id="s_x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&amp;f0=<?php echo ew_Encrypt("[Estanteria_Id] = {filter_value}"); ?>&amp;t0=3">
</span>
<?php } else { ?>
<span id="el$rowindex$_in_bodegaubicaciones_Estanteria_Id" class="form-group in_bodegaubicaciones_Estanteria_Id">
<span<?php echo $in_bodegaubicaciones->Estanteria_Id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->Estanteria_Id->ViewValue ?></p></span>
</span>
<input type="hidden" data-field="x_Estanteria_Id" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Estanteria_Id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_Estanteria_Id" name="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" id="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Estanteria_Id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Estanteria_Id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($in_bodegaubicaciones->Seccion_id->Visible) { // Seccion_id ?>
		<td data-name="Seccion_id">
<?php if ($in_bodegaubicaciones->CurrentAction <> "F") { ?>
<span id="el$rowindex$_in_bodegaubicaciones_Seccion_id" class="form-group in_bodegaubicaciones_Seccion_id">
<select data-field="x_Seccion_id" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id"<?php echo $in_bodegaubicaciones->Seccion_id->EditAttributes() ?>>
<?php
if (is_array($in_bodegaubicaciones->Seccion_id->EditValue)) {
	$arwrk = $in_bodegaubicaciones->Seccion_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($in_bodegaubicaciones->Seccion_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $in_bodegaubicaciones->Seccion_id->OldValue = "";
?>
</select>
<?php
 $sSqlWrk = "SELECT [Seccion_Id], [descripcion] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [dbo].[in_seccionestanteria]";
 $sWhereWrk = "";

 // Call Lookup selecting
 $in_bodegaubicaciones->Lookup_Selecting($in_bodegaubicaciones->Seccion_id, $sWhereWrk);
 if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" id="s_x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&amp;f0=<?php echo ew_Encrypt("[Seccion_Id] = {filter_value}"); ?>&amp;t0=3">
</span>
<?php } else { ?>
<span id="el$rowindex$_in_bodegaubicaciones_Seccion_id" class="form-group in_bodegaubicaciones_Seccion_id">
<span<?php echo $in_bodegaubicaciones->Seccion_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->Seccion_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-field="x_Seccion_id" name="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" id="x<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Seccion_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_Seccion_id" name="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" id="o<?php echo $in_bodegaubicaciones_grid->RowIndex ?>_Seccion_id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Seccion_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$in_bodegaubicaciones_grid->ListOptions->Render("body", "right", $in_bodegaubicaciones_grid->RowCnt);
?>
<script type="text/javascript">
fin_bodegaubicacionesgrid.UpdateOpts(<?php echo $in_bodegaubicaciones_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($in_bodegaubicaciones->CurrentMode == "add" || $in_bodegaubicaciones->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $in_bodegaubicaciones_grid->FormKeyCountName ?>" id="<?php echo $in_bodegaubicaciones_grid->FormKeyCountName ?>" value="<?php echo $in_bodegaubicaciones_grid->KeyCount ?>">
<?php echo $in_bodegaubicaciones_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($in_bodegaubicaciones->CurrentMode == "edit") { ?>
<?php if ($in_bodegaubicaciones->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="a_list" id="a_list" value="gridoverwrite">
<?php } else { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<?php } ?>
<input type="hidden" name="<?php echo $in_bodegaubicaciones_grid->FormKeyCountName ?>" id="<?php echo $in_bodegaubicaciones_grid->FormKeyCountName ?>" value="<?php echo $in_bodegaubicaciones_grid->KeyCount ?>">
<?php echo $in_bodegaubicaciones_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($in_bodegaubicaciones->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fin_bodegaubicacionesgrid">
</div>
<?php

// Close recordset
if ($in_bodegaubicaciones_grid->Recordset)
	$in_bodegaubicaciones_grid->Recordset->Close();
?>
<?php if ($in_bodegaubicaciones_grid->ShowOtherOptions) { ?>
<div class="ewGridLowerPanel">
<?php
	foreach ($in_bodegaubicaciones_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($in_bodegaubicaciones_grid->TotalRecs == 0 && $in_bodegaubicaciones->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($in_bodegaubicaciones_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($in_bodegaubicaciones->Export == "") { ?>
<script type="text/javascript">
fin_bodegaubicacionesgrid.Init();
</script>
<?php } ?>
<?php
$in_bodegaubicaciones_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$in_bodegaubicaciones_grid->Page_Terminate();
?>
