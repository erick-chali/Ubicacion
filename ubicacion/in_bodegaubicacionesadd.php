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

$in_bodegaubicaciones_add = NULL; // Initialize page object first

class cin_bodegaubicaciones_add extends cin_bodegaubicaciones {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{61E4280F-6622-4502-933A-764E36139766}";

	// Table name
	var $TableName = 'in_bodegaubicaciones';

	// Page object name
	var $PageObjName = 'in_bodegaubicaciones_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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

		// Create form object
		$objForm = new cFormObj();
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
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["codigo_bodega"] != "") {
				$this->codigo_bodega->setQueryStringValue($_GET["codigo_bodega"]);
				$this->setKey("codigo_bodega", $this->codigo_bodega->CurrentValue); // Set up key
			} else {
				$this->setKey("codigo_bodega", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (@$_GET["Estanteria_Id"] != "") {
				$this->Estanteria_Id->setQueryStringValue($_GET["Estanteria_Id"]);
				$this->setKey("Estanteria_Id", $this->Estanteria_Id->CurrentValue); // Set up key
			} else {
				$this->setKey("Estanteria_Id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (@$_GET["Seccion_id"] != "") {
				$this->Seccion_id->setQueryStringValue($_GET["Seccion_id"]);
				$this->setKey("Seccion_id", $this->Seccion_id->CurrentValue); // Set up key
			} else {
				$this->setKey("Seccion_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform action based on action code
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("in_bodegaubicacioneslist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "in_bodegaubicacionesview.php")
						$sReturnUrl = $this->GetViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		if ($this->CurrentAction == "F") { // Confirm page
		  $this->RowType = EW_ROWTYPE_VIEW; // Render view type
		} else {
		  $this->RowType = EW_ROWTYPE_ADD; // Render add type
		}

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->codigo_bodega->CurrentValue = NULL;
		$this->codigo_bodega->OldValue = $this->codigo_bodega->CurrentValue;
		$this->Estanteria_Id->CurrentValue = NULL;
		$this->Estanteria_Id->OldValue = $this->Estanteria_Id->CurrentValue;
		$this->Seccion_id->CurrentValue = NULL;
		$this->Seccion_id->OldValue = $this->Seccion_id->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->codigo_bodega->FldIsDetailKey) {
			$this->codigo_bodega->setFormValue($objForm->GetValue("x_codigo_bodega"));
		}
		if (!$this->Estanteria_Id->FldIsDetailKey) {
			$this->Estanteria_Id->setFormValue($objForm->GetValue("x_Estanteria_Id"));
		}
		if (!$this->Seccion_id->FldIsDetailKey) {
			$this->Seccion_id->setFormValue($objForm->GetValue("x_Seccion_id"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->codigo_bodega->CurrentValue = $this->codigo_bodega->FormValue;
		$this->Estanteria_Id->CurrentValue = $this->Estanteria_Id->FormValue;
		$this->Seccion_id->CurrentValue = $this->Seccion_id->FormValue;
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("codigo_bodega")) <> "")
			$this->codigo_bodega->CurrentValue = $this->getKey("codigo_bodega"); // codigo_bodega
		else
			$bValidKey = FALSE;
		if (strval($this->getKey("Estanteria_Id")) <> "")
			$this->Estanteria_Id->CurrentValue = $this->getKey("Estanteria_Id"); // Estanteria_Id
		else
			$bValidKey = FALSE;
		if (strval($this->getKey("Seccion_id")) <> "")
			$this->Seccion_id->CurrentValue = $this->getKey("Seccion_id"); // Seccion_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// codigo_bodega
			$this->codigo_bodega->EditAttrs["class"] = "form-control";
			$this->codigo_bodega->EditCustomAttributes = "";
			if ($this->codigo_bodega->getSessionValue() <> "") {
				$this->codigo_bodega->CurrentValue = $this->codigo_bodega->getSessionValue();
			$this->codigo_bodega->ViewValue = $this->codigo_bodega->CurrentValue;
			$this->codigo_bodega->ViewCustomAttributes = "";
			} else {
			$this->codigo_bodega->EditValue = ew_HtmlEncode($this->codigo_bodega->CurrentValue);
			$this->codigo_bodega->PlaceHolder = ew_RemoveHtml($this->codigo_bodega->FldCaption());
			}

			// Estanteria_Id
			$this->Estanteria_Id->EditAttrs["class"] = "form-control";
			$this->Estanteria_Id->EditCustomAttributes = "";
			if (trim(strval($this->Estanteria_Id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "[Estanteria_Id]" . ew_SearchString("=", $this->Estanteria_Id->CurrentValue, EW_DATATYPE_NUMBER);
			}
			$sSqlWrk = "SELECT [Estanteria_Id], [descripcion] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld], '' AS [SelectFilterFld], '' AS [SelectFilterFld2], '' AS [SelectFilterFld3], '' AS [SelectFilterFld4] FROM [dbo].[in_estanteria]";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->Estanteria_Id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->Estanteria_Id->EditValue = $arwrk;

			// Seccion_id
			$this->Seccion_id->EditAttrs["class"] = "form-control";
			$this->Seccion_id->EditCustomAttributes = "";
			if (trim(strval($this->Seccion_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "[Seccion_Id]" . ew_SearchString("=", $this->Seccion_id->CurrentValue, EW_DATATYPE_NUMBER);
			}
			$sSqlWrk = "SELECT [Seccion_Id], [descripcion] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld], '' AS [SelectFilterFld], '' AS [SelectFilterFld2], '' AS [SelectFilterFld3], '' AS [SelectFilterFld4] FROM [dbo].[in_seccionestanteria]";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->Seccion_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->Seccion_id->EditValue = $arwrk;

			// Edit refer script
			// codigo_bodega

			$this->codigo_bodega->HrefValue = "";

			// Estanteria_Id
			$this->Estanteria_Id->HrefValue = "";

			// Seccion_id
			$this->Seccion_id->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->codigo_bodega->FldIsDetailKey && !is_null($this->codigo_bodega->FormValue) && $this->codigo_bodega->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->codigo_bodega->FldCaption(), $this->codigo_bodega->ReqErrMsg));
		}
		if (!$this->Estanteria_Id->FldIsDetailKey && !is_null($this->Estanteria_Id->FormValue) && $this->Estanteria_Id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Estanteria_Id->FldCaption(), $this->Estanteria_Id->ReqErrMsg));
		}
		if (!$this->Seccion_id->FldIsDetailKey && !is_null($this->Seccion_id->FormValue) && $this->Seccion_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Seccion_id->FldCaption(), $this->Seccion_id->ReqErrMsg));
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security;

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// codigo_bodega
		$this->codigo_bodega->SetDbValueDef($rsnew, $this->codigo_bodega->CurrentValue, "", FALSE);

		// Estanteria_Id
		$this->Estanteria_Id->SetDbValueDef($rsnew, $this->Estanteria_Id->CurrentValue, 0, FALSE);

		// Seccion_id
		$this->Seccion_id->SetDbValueDef($rsnew, $this->Seccion_id->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($bInsertRow && $this->ValidateKey && strval($rsnew['codigo_bodega']) == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			$bInsertRow = FALSE;
		}

		// Check if key value entered
		if ($bInsertRow && $this->ValidateKey && strval($rsnew['Estanteria_Id']) == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			$bInsertRow = FALSE;
		}

		// Check if key value entered
		if ($bInsertRow && $this->ValidateKey && strval($rsnew['Seccion_id']) == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			$bInsertRow = FALSE;
		}

		// Check for duplicate key
		if ($bInsertRow && $this->ValidateKey) {
			$sFilter = $this->KeyFilter();
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				$bInsertRow = FALSE;
			}
		}
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($in_bodegaubicaciones_add)) $in_bodegaubicaciones_add = new cin_bodegaubicaciones_add();

// Page init
$in_bodegaubicaciones_add->Page_Init();

// Page main
$in_bodegaubicaciones_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$in_bodegaubicaciones_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var in_bodegaubicaciones_add = new ew_Page("in_bodegaubicaciones_add");
in_bodegaubicaciones_add.PageID = "add"; // Page ID
var EW_PAGE_ID = in_bodegaubicaciones_add.PageID; // For backward compatibility

// Form object
var fin_bodegaubicacionesadd = new ew_Form("fin_bodegaubicacionesadd");

// Validate form
fin_bodegaubicacionesadd.Validate = function() {
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
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fin_bodegaubicacionesadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fin_bodegaubicacionesadd.ValidateRequired = true;
<?php } else { ?>
fin_bodegaubicacionesadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fin_bodegaubicacionesadd.Lists["x_Estanteria_Id"] = {"LinkField":"x_Estanteria_Id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};
fin_bodegaubicacionesadd.Lists["x_Seccion_id"] = {"LinkField":"x_Seccion_Id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $in_bodegaubicaciones_add->ShowPageHeader(); ?>
<?php
$in_bodegaubicaciones_add->ShowMessage();
?>
<form name="fin_bodegaubicacionesadd" id="fin_bodegaubicacionesadd" class="form-horizontal ewForm ewAddForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($in_bodegaubicaciones_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $in_bodegaubicaciones_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="in_bodegaubicaciones">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($in_bodegaubicaciones->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<div>
<?php if ($in_bodegaubicaciones->codigo_bodega->Visible) { // codigo_bodega ?>
	<div id="r_codigo_bodega" class="form-group">
		<label id="elh_in_bodegaubicaciones_codigo_bodega" for="x_codigo_bodega" class="col-sm-2 control-label ewLabel"><?php echo $in_bodegaubicaciones->codigo_bodega->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $in_bodegaubicaciones->codigo_bodega->CellAttributes() ?>>
<?php if ($in_bodegaubicaciones->CurrentAction <> "F") { ?>
<?php if ($in_bodegaubicaciones->codigo_bodega->getSessionValue() <> "") { ?>
<span id="el_in_bodegaubicaciones_codigo_bodega">
<span<?php echo $in_bodegaubicaciones->codigo_bodega->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->codigo_bodega->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_codigo_bodega" name="x_codigo_bodega" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->CurrentValue) ?>">
<?php } else { ?>
<span id="el_in_bodegaubicaciones_codigo_bodega">
<input type="text" data-field="x_codigo_bodega" name="x_codigo_bodega" id="x_codigo_bodega" size="30" placeholder="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->PlaceHolder) ?>" value="<?php echo $in_bodegaubicaciones->codigo_bodega->EditValue ?>"<?php echo $in_bodegaubicaciones->codigo_bodega->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_in_bodegaubicaciones_codigo_bodega">
<span<?php echo $in_bodegaubicaciones->codigo_bodega->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->codigo_bodega->ViewValue ?></p></span>
</span>
<input type="hidden" data-field="x_codigo_bodega" name="x_codigo_bodega" id="x_codigo_bodega" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->codigo_bodega->FormValue) ?>">
<?php } ?>
<?php echo $in_bodegaubicaciones->codigo_bodega->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($in_bodegaubicaciones->Estanteria_Id->Visible) { // Estanteria_Id ?>
	<div id="r_Estanteria_Id" class="form-group">
		<label id="elh_in_bodegaubicaciones_Estanteria_Id" for="x_Estanteria_Id" class="col-sm-2 control-label ewLabel"><?php echo $in_bodegaubicaciones->Estanteria_Id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $in_bodegaubicaciones->Estanteria_Id->CellAttributes() ?>>
<?php if ($in_bodegaubicaciones->CurrentAction <> "F") { ?>
<span id="el_in_bodegaubicaciones_Estanteria_Id">
<select data-field="x_Estanteria_Id" id="x_Estanteria_Id" name="x_Estanteria_Id"<?php echo $in_bodegaubicaciones->Estanteria_Id->EditAttributes() ?>>
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
?>
</select>
<?php
$sSqlWrk = "SELECT [Estanteria_Id], [descripcion] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [dbo].[in_estanteria]";
$sWhereWrk = "";

// Call Lookup selecting
$in_bodegaubicaciones->Lookup_Selecting($in_bodegaubicaciones->Estanteria_Id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x_Estanteria_Id" id="s_x_Estanteria_Id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&amp;f0=<?php echo ew_Encrypt("[Estanteria_Id] = {filter_value}"); ?>&amp;t0=3">
</span>
<?php } else { ?>
<span id="el_in_bodegaubicaciones_Estanteria_Id">
<span<?php echo $in_bodegaubicaciones->Estanteria_Id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->Estanteria_Id->ViewValue ?></p></span>
</span>
<input type="hidden" data-field="x_Estanteria_Id" name="x_Estanteria_Id" id="x_Estanteria_Id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Estanteria_Id->FormValue) ?>">
<?php } ?>
<?php echo $in_bodegaubicaciones->Estanteria_Id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($in_bodegaubicaciones->Seccion_id->Visible) { // Seccion_id ?>
	<div id="r_Seccion_id" class="form-group">
		<label id="elh_in_bodegaubicaciones_Seccion_id" for="x_Seccion_id" class="col-sm-2 control-label ewLabel"><?php echo $in_bodegaubicaciones->Seccion_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $in_bodegaubicaciones->Seccion_id->CellAttributes() ?>>
<?php if ($in_bodegaubicaciones->CurrentAction <> "F") { ?>
<span id="el_in_bodegaubicaciones_Seccion_id">
<select data-field="x_Seccion_id" id="x_Seccion_id" name="x_Seccion_id"<?php echo $in_bodegaubicaciones->Seccion_id->EditAttributes() ?>>
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
?>
</select>
<?php
$sSqlWrk = "SELECT [Seccion_Id], [descripcion] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [dbo].[in_seccionestanteria]";
$sWhereWrk = "";

// Call Lookup selecting
$in_bodegaubicaciones->Lookup_Selecting($in_bodegaubicaciones->Seccion_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x_Seccion_id" id="s_x_Seccion_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&amp;f0=<?php echo ew_Encrypt("[Seccion_Id] = {filter_value}"); ?>&amp;t0=3">
</span>
<?php } else { ?>
<span id="el_in_bodegaubicaciones_Seccion_id">
<span<?php echo $in_bodegaubicaciones->Seccion_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $in_bodegaubicaciones->Seccion_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-field="x_Seccion_id" name="x_Seccion_id" id="x_Seccion_id" value="<?php echo ew_HtmlEncode($in_bodegaubicaciones->Seccion_id->FormValue) ?>">
<?php } ?>
<?php echo $in_bodegaubicaciones->Seccion_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<?php if ($in_bodegaubicaciones->CurrentAction <> "F") { // Confirm page ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit" onclick="this.form.a_add.value='F';"><?php echo $Language->Phrase("AddBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="submit" onclick="this.form.a_add.value='X';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
	</div>
</div>
</form>
<script type="text/javascript">
fin_bodegaubicacionesadd.Init();
</script>
<?php
$in_bodegaubicaciones_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$in_bodegaubicaciones_add->Page_Terminate();
?>
