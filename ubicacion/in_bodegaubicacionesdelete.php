<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg11.php" ?>
<?php include_once "adodb5/adodb.inc.php" ?>
<?php include_once "phpfn11.php" ?>
<?php include_once "in_bodegaubicacionesinfo.php" ?>
<?php include_once "_Usersinfo.php" ?>
<?php include_once "in_bodegasinfo.php" ?>
<?php include_once "userfn11.php" ?>
<?php

//
// Page class
//

$in_bodegaubicaciones_delete = NULL; // Initialize page object first

class cin_bodegaubicaciones_delete extends cin_bodegaubicaciones {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{61E4280F-6622-4502-933A-764E36139766}";

	// Table name
	var $TableName = 'in_bodegaubicaciones';

	// Page object name
	var $PageObjName = 'in_bodegaubicaciones_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME]);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		$GLOBALS["Page"] = &$this;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (in_bodegaubicaciones)
		if (!isset($GLOBALS["in_bodegaubicaciones"]) || get_class($GLOBALS["in_bodegaubicaciones"]) == "cin_bodegaubicaciones") {
			$GLOBALS["in_bodegaubicaciones"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["in_bodegaubicaciones"];
		}

		// Table object (_Users)
		if (!isset($GLOBALS['_Users'])) $GLOBALS['_Users'] = new c_Users();

		// Table object (in_bodegas)
		if (!isset($GLOBALS['in_bodegas'])) $GLOBALS['in_bodegas'] = new cin_bodegas();

		// User table object (_Users)
		if (!isset($GLOBALS["UserTable"])) $GLOBALS["UserTable"] = new c_Users();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'in_bodegaubicaciones', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		$Security->TablePermission_Loaded();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn, $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $in_bodegaubicaciones;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($in_bodegaubicaciones);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("in_bodegaubicacioneslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in in_bodegaubicaciones class, in_bodegaubicacionesinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		switch ($this->CurrentAction) {
			case "D": // Delete
				$this->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // Delete rows
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($this->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn;

		// Load List page SQL
		$sSql = $this->SelectSQL();

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->codigo_bodega->setDbValue($rs->fields('codigo_bodega'));
		$this->Estanteria_Id->setDbValue($rs->fields('Estanteria_Id'));
		if (array_key_exists('EV__Estanteria_Id', $rs->fields)) {
			$this->Estanteria_Id->VirtualValue = $rs->fields('EV__Estanteria_Id'); // Set up virtual field value
		} else {
			$this->Estanteria_Id->VirtualValue = ""; // Clear value
		}
		$this->Seccion_id->setDbValue($rs->fields('Seccion_id'));
		if (array_key_exists('EV__Seccion_id', $rs->fields)) {
			$this->Seccion_id->VirtualValue = $rs->fields('EV__Seccion_id'); // Set up virtual field value
		} else {
			$this->Seccion_id->VirtualValue = ""; // Clear value
		}
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->codigo_bodega->DbValue = $row['codigo_bodega'];
		$this->Estanteria_Id->DbValue = $row['Estanteria_Id'];
		$this->Seccion_id->DbValue = $row['Seccion_id'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// codigo_bodega
		// Estanteria_Id
		// Seccion_id

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// codigo_bodega
			$this->codigo_bodega->ViewValue = $this->codigo_bodega->CurrentValue;
			$this->codigo_bodega->ViewCustomAttributes = "";

			// Estanteria_Id
			if ($this->Estanteria_Id->VirtualValue <> "") {
				$this->Estanteria_Id->ViewValue = $this->Estanteria_Id->VirtualValue;
			} else {
			if (strval($this->Estanteria_Id->CurrentValue) <> "") {
				$sFilterWrk = "[Estanteria_Id]" . ew_SearchString("=", $this->Estanteria_Id->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT [Estanteria_Id], [descripcion] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [dbo].[in_estanteria]";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->Estanteria_Id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->Estanteria_Id->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->Estanteria_Id->ViewValue = $this->Estanteria_Id->CurrentValue;
				}
			} else {
				$this->Estanteria_Id->ViewValue = NULL;
			}
			}
			$this->Estanteria_Id->ViewCustomAttributes = "";

			// Seccion_id
			if ($this->Seccion_id->VirtualValue <> "") {
				$this->Seccion_id->ViewValue = $this->Seccion_id->VirtualValue;
			} else {
			if (strval($this->Seccion_id->CurrentValue) <> "") {
				$sFilterWrk = "[Seccion_Id]" . ew_SearchString("=", $this->Seccion_id->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT [Seccion_Id], [descripcion] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [dbo].[in_seccionestanteria]";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->Seccion_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->Seccion_id->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->Seccion_id->ViewValue = $this->Seccion_id->CurrentValue;
				}
			} else {
				$this->Seccion_id->ViewValue = NULL;
			}
			}
			$this->Seccion_id->ViewCustomAttributes = "";

			// codigo_bodega
			$this->codigo_bodega->LinkCustomAttributes = "";
			$this->codigo_bodega->HrefValue = "";
			$this->codigo_bodega->TooltipValue = "";

			// Estanteria_Id
			$this->Estanteria_Id->LinkCustomAttributes = "";
			$this->Estanteria_Id->HrefValue = "";
			$this->Estanteria_Id->TooltipValue = "";

			// Seccion_id
			$this->Seccion_id->LinkCustomAttributes = "";
			$this->Seccion_id->HrefValue = "";
			$this->Seccion_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['codigo_bodega'];
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['Estanteria_Id'];
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['Seccion_id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "in_bodegas") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_codigo_bodega"] <> "") {
					$GLOBALS["in_bodegas"]->codigo_bodega->setQueryStringValue($_GET["fk_codigo_bodega"]);
					$this->codigo_bodega->setQueryStringValue($GLOBALS["in_bodegas"]->codigo_bodega->QueryStringValue);
					$this->codigo_bodega->setSessionValue($this->codigo_bodega->QueryStringValue);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "in_bodegas") {
				if ($this->codigo_bodega->QueryStringValue == "") $this->codigo_bodega->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, "in_bodegaubicacioneslist.php", "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($in_bodegaubicaciones_delete)) $in_bodegaubicaciones_delete = new cin_bodegaubicaciones_delete();

// Page init
$in_bodegaubicaciones_delete->Page_Init();

// Page main
$in_bodegaubicaciones_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$in_bodegaubicaciones_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var in_bodegaubicaciones_delete = new ew_Page("in_bodegaubicaciones_delete");
in_bodegaubicaciones_delete.PageID = "delete"; // Page ID
var EW_PAGE_ID = in_bodegaubicaciones_delete.PageID; // For backward compatibility

// Form object
var fin_bodegaubicacionesdelete = new ew_Form("fin_bodegaubicacionesdelete");

// Form_CustomValidate event
fin_bodegaubicacionesdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fin_bodegaubicacionesdelete.ValidateRequired = true;
<?php } else { ?>
fin_bodegaubicacionesdelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fin_bodegaubicacionesdelete.Lists["x_Estanteria_Id"] = {"LinkField":"x_Estanteria_Id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};
fin_bodegaubicacionesdelete.Lists["x_Seccion_id"] = {"LinkField":"x_Seccion_Id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php

// Load records for display
if ($in_bodegaubicaciones_delete->Recordset = $in_bodegaubicaciones_delete->LoadRecordset())
	$in_bodegaubicaciones_deleteTotalRecs = $in_bodegaubicaciones_delete->Recordset->RecordCount(); // Get record count
if ($in_bodegaubicaciones_deleteTotalRecs <= 0) { // No record found, exit
	if ($in_bodegaubicaciones_delete->Recordset)
		$in_bodegaubicaciones_delete->Recordset->Close();
	$in_bodegaubicaciones_delete->Page_Terminate("in_bodegaubicacioneslist.php"); // Return to list
}
?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $in_bodegaubicaciones_delete->ShowPageHeader(); ?>
<?php
$in_bodegaubicaciones_delete->ShowMessage();
?>
<form name="fin_bodegaubicacionesdelete" id="fin_bodegaubicacionesdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($in_bodegaubicaciones_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $in_bodegaubicaciones_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="in_bodegaubicaciones">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($in_bodegaubicaciones_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table class="table ewTable">
<?php echo $in_bodegaubicaciones->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($in_bodegaubicaciones->codigo_bodega->Visible) { // codigo_bodega ?>
		<th><span id="elh_in_bodegaubicaciones_codigo_bodega" class="in_bodegaubicaciones_codigo_bodega"><?php echo $in_bodegaubicaciones->codigo_bodega->FldCaption() ?></span></th>
<?php } ?>
<?php if ($in_bodegaubicaciones->Estanteria_Id->Visible) { // Estanteria_Id ?>
		<th><span id="elh_in_bodegaubicaciones_Estanteria_Id" class="in_bodegaubicaciones_Estanteria_Id"><?php echo $in_bodegaubicaciones->Estanteria_Id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($in_bodegaubicaciones->Seccion_id->Visible) { // Seccion_id ?>
		<th><span id="elh_in_bodegaubicaciones_Seccion_id" class="in_bodegaubicaciones_Seccion_id"><?php echo $in_bodegaubicaciones->Seccion_id->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$in_bodegaubicaciones_delete->RecCnt = 0;
$i = 0;
while (!$in_bodegaubicaciones_delete->Recordset->EOF) {
	$in_bodegaubicaciones_delete->RecCnt++;
	$in_bodegaubicaciones_delete->RowCnt++;

	// Set row properties
	$in_bodegaubicaciones->ResetAttrs();
	$in_bodegaubicaciones->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$in_bodegaubicaciones_delete->LoadRowValues($in_bodegaubicaciones_delete->Recordset);

	// Render row
	$in_bodegaubicaciones_delete->RenderRow();
?>
	<tr<?php echo $in_bodegaubicaciones->RowAttributes() ?>>
<?php if ($in_bodegaubicaciones->codigo_bodega->Visible) { // codigo_bodega ?>
		<td<?php echo $in_bodegaubicaciones->codigo_bodega->CellAttributes() ?>>
<span id="el<?php echo $in_bodegaubicaciones_delete->RowCnt ?>_in_bodegaubicaciones_codigo_bodega" class="in_bodegaubicaciones_codigo_bodega">
<span<?php echo $in_bodegaubicaciones->codigo_bodega->ViewAttributes() ?>>
<?php echo $in_bodegaubicaciones->codigo_bodega->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($in_bodegaubicaciones->Estanteria_Id->Visible) { // Estanteria_Id ?>
		<td<?php echo $in_bodegaubicaciones->Estanteria_Id->CellAttributes() ?>>
<span id="el<?php echo $in_bodegaubicaciones_delete->RowCnt ?>_in_bodegaubicaciones_Estanteria_Id" class="in_bodegaubicaciones_Estanteria_Id">
<span<?php echo $in_bodegaubicaciones->Estanteria_Id->ViewAttributes() ?>>
<?php echo $in_bodegaubicaciones->Estanteria_Id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($in_bodegaubicaciones->Seccion_id->Visible) { // Seccion_id ?>
		<td<?php echo $in_bodegaubicaciones->Seccion_id->CellAttributes() ?>>
<span id="el<?php echo $in_bodegaubicaciones_delete->RowCnt ?>_in_bodegaubicaciones_Seccion_id" class="in_bodegaubicaciones_Seccion_id">
<span<?php echo $in_bodegaubicaciones->Seccion_id->ViewAttributes() ?>>
<?php echo $in_bodegaubicaciones->Seccion_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$in_bodegaubicaciones_delete->Recordset->MoveNext();
}
$in_bodegaubicaciones_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div class="btn-group ewButtonGroup">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fin_bodegaubicacionesdelete.Init();
</script>
<?php
$in_bodegaubicaciones_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$in_bodegaubicaciones_delete->Page_Terminate();
?>
