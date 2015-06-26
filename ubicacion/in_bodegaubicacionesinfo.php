<?php

// Global variable for table object
$in_bodegaubicaciones = NULL;

//
// Table class for in_bodegaubicaciones
//
class cin_bodegaubicaciones extends cTable {
	var $codigo_bodega;
	var $Estanteria_Id;
	var $Seccion_id;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'in_bodegaubicaciones';
		$this->TableName = 'in_bodegaubicaciones';
		$this->TableType = 'TABLE';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4; // Page size (PHPExcel only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// codigo_bodega
		$this->codigo_bodega = new cField('in_bodegaubicaciones', 'in_bodegaubicaciones', 'x_codigo_bodega', 'codigo_bodega', '[codigo_bodega]', '[codigo_bodega]', 129, -1, FALSE, '[codigo_bodega]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['codigo_bodega'] = &$this->codigo_bodega;

		// Estanteria_Id
		$this->Estanteria_Id = new cField('in_bodegaubicaciones', 'in_bodegaubicaciones', 'x_Estanteria_Id', 'Estanteria_Id', '[Estanteria_Id]', 'CAST([Estanteria_Id] AS NVARCHAR)', 3, -1, FALSE, '[EV__Estanteria_Id]', TRUE, TRUE, TRUE, 'FORMATTED TEXT');
		$this->Estanteria_Id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Estanteria_Id'] = &$this->Estanteria_Id;

		// Seccion_id
		$this->Seccion_id = new cField('in_bodegaubicaciones', 'in_bodegaubicaciones', 'x_Seccion_id', 'Seccion_id', '[Seccion_id]', 'CAST([Seccion_id] AS NVARCHAR)', 3, -1, FALSE, '[EV__Seccion_id]', TRUE, TRUE, TRUE, 'FORMATTED TEXT');
		$this->Seccion_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Seccion_id'] = &$this->Seccion_id;
	}

	// Session ORDER BY for List page
	function getSessionOrderByList() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST];
	}

	function setSessionOrderByList($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST] = $v;
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function GetMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "in_bodegas") {
			if ($this->codigo_bodega->getSessionValue() <> "")
				$sMasterFilter .= "[codigo_bodega]=" . ew_QuotedValue($this->codigo_bodega->getSessionValue(), EW_DATATYPE_STRING);
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "in_bodegas") {
			if ($this->codigo_bodega->getSessionValue() <> "")
				$sDetailFilter .= "[codigo_bodega]=" . ew_QuotedValue($this->codigo_bodega->getSessionValue(), EW_DATATYPE_STRING);
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_in_bodegas() {
		return "[codigo_bodega]='@codigo_bodega@'";
	}

	// Detail filter
	function SqlDetailFilter_in_bodegas() {
		return "[codigo_bodega]='@codigo_bodega@'";
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "[dbo].[in_bodegaubicaciones]";
	}

	function SqlFrom() { // For backward compatibility
    	return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
    	$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
    	return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
    	$this->_SqlSelect = $v;
	}
	var $_SqlSelectList = "";

	function getSqlSelectList() { // Select for List page
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT TOP 1 [descripcion] FROM [dbo].[in_estanteria] [EW_TMP_LOOKUPTABLE] WHERE [EW_TMP_LOOKUPTABLE].[Estanteria_Id] = [in_bodegaubicaciones].[Estanteria_Id]) AS [EV__Estanteria_Id], (SELECT TOP 1 [descripcion] FROM [dbo].[in_seccionestanteria] [EW_TMP_LOOKUPTABLE] WHERE [EW_TMP_LOOKUPTABLE].[Seccion_Id] = [in_bodegaubicaciones].[Seccion_id]) AS [EV__Seccion_id] FROM [dbo].[in_bodegaubicaciones]" .
			") [EW_TMP_TABLE]";
		return ($this->_SqlSelectList <> "") ? $this->_SqlSelectList : $select;
	}

	function SqlSelectList() { // For backward compatibility
    	return $this->getSqlSelectList();
	}

	function setSqlSelectList($v) {
    	$this->_SqlSelectList = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
    	return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
    	$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
    	return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
    	$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
    	return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
    	$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "[codigo_bodega] ASC";
	}

	function SqlOrderBy() { // For backward compatibility
    	return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
    	$this->_SqlOrderBy = $v;
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (@$this->PageID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		if ($this->UseVirtualFields()) {
			$sSort = $this->getSessionOrderByList();
			return ew_BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		} else {
			$sSort = $this->getSessionOrderBy();
			return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		}
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = ($this->UseVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Check if virtual fields is used in SQL
	function UseVirtualFields() {
		$sWhere = $this->getSessionWhere();
		$sOrderBy = $this->getSessionOrderByList();
		if ($sWhere <> "")
			$sWhere = " " . str_replace(array("(",")"), array("",""), $sWhere) . " ";
		if ($sOrderBy <> "")
			$sOrderBy = " " . str_replace(array("(",")"), array("",""), $sOrderBy) . " ";
		if ($this->Estanteria_Id->AdvancedSearch->SearchValue <> "" ||
			$this->Estanteria_Id->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->Estanteria_Id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->Estanteria_Id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if ($this->Seccion_id->AdvancedSearch->SearchValue <> "" ||
			$this->Seccion_id->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->Seccion_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->Seccion_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		return FALSE;
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Update Table
	var $UpdateTable = "[dbo].[in_bodegaubicaciones]";

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]))
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			if (in_array($this->fields[$name]->FldType, array(130, 202, 203)) && !is_null($value))
				$values .= 'N';
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		global $conn;
		return $conn->Execute($this->InsertSQL($rs));
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "") {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]))
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			if (in_array($this->fields[$name]->FldType, array(130, 202, 203)) && !is_null($value))
				$sql .= 'N';
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = $this->CurrentFilter;
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL) {
		global $conn;
		return $conn->Execute($this->UpdateSQL($rs, $where));
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "") {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if ($rs) {
			if (array_key_exists('codigo_bodega', $rs))
				ew_AddFilter($where, ew_QuotedName('codigo_bodega') . '=' . ew_QuotedValue($rs['codigo_bodega'], $this->codigo_bodega->FldDataType));
			if (array_key_exists('Estanteria_Id', $rs))
				ew_AddFilter($where, ew_QuotedName('Estanteria_Id') . '=' . ew_QuotedValue($rs['Estanteria_Id'], $this->Estanteria_Id->FldDataType));
			if (array_key_exists('Seccion_id', $rs))
				ew_AddFilter($where, ew_QuotedName('Seccion_id') . '=' . ew_QuotedValue($rs['Seccion_id'], $this->Seccion_id->FldDataType));
		}
		$filter = $this->CurrentFilter;
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "") {
		global $conn;
		return $conn->Execute($this->DeleteSQL($rs, $where));
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "[codigo_bodega] = '@codigo_bodega@' AND [Estanteria_Id] = @Estanteria_Id@ AND [Seccion_id] = @Seccion_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@codigo_bodega@", ew_AdjustSql($this->codigo_bodega->CurrentValue), $sKeyFilter); // Replace key value
		if (!is_numeric($this->Estanteria_Id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@Estanteria_Id@", ew_AdjustSql($this->Estanteria_Id->CurrentValue), $sKeyFilter); // Replace key value
		if (!is_numeric($this->Seccion_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@Seccion_id@", ew_AdjustSql($this->Seccion_id->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "in_bodegaubicacioneslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "in_bodegaubicacioneslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("in_bodegaubicacionesview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("in_bodegaubicacionesview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "in_bodegaubicacionesadd.php?" . $this->UrlParm($parm);
		else
			return "in_bodegaubicacionesadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("in_bodegaubicacionesedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("in_bodegaubicacionesadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("in_bodegaubicacionesdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->codigo_bodega->CurrentValue)) {
			$sUrl .= "codigo_bodega=" . urlencode($this->codigo_bodega->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->Estanteria_Id->CurrentValue)) {
			$sUrl .= "&Estanteria_Id=" . urlencode($this->Estanteria_Id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->Seccion_id->CurrentValue)) {
			$sUrl .= "&Seccion_id=" . urlencode($this->Seccion_id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		return "";
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode($EW_COMPOSITE_KEY_SEPARATOR, $arKeys[$i]);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode($EW_COMPOSITE_KEY_SEPARATOR, $arKeys[$i]);
		} elseif (isset($_GET)) {
			$arKey[] = @$_GET["codigo_bodega"]; // codigo_bodega
			$arKey[] = @$_GET["Estanteria_Id"]; // Estanteria_Id
			$arKey[] = @$_GET["Seccion_id"]; // Seccion_id
			$arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		foreach ($arKeys as $key) {
			if (!is_array($key) || count($key) <> 3)
				continue; // Just skip so other keys will still work
			if (!is_numeric($key[1])) // Estanteria_Id
				continue;
			if (!is_numeric($key[2])) // Seccion_id
				continue;
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->codigo_bodega->CurrentValue = $key[0];
			$this->Estanteria_Id->CurrentValue = $key[1];
			$this->Seccion_id->CurrentValue = $key[2];
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->codigo_bodega->setDbValue($rs->fields('codigo_bodega'));
		$this->Estanteria_Id->setDbValue($rs->fields('Estanteria_Id'));
		$this->Seccion_id->setDbValue($rs->fields('Seccion_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// codigo_bodega
		// Estanteria_Id
		// Seccion_id
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

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $conn, $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// codigo_bodega
		$this->codigo_bodega->EditAttrs["class"] = "form-control";
		$this->codigo_bodega->EditCustomAttributes = "";
		$this->codigo_bodega->EditValue = $this->codigo_bodega->CurrentValue;
		$this->codigo_bodega->ViewCustomAttributes = "";

		// Estanteria_Id
		$this->Estanteria_Id->EditAttrs["class"] = "form-control";
		$this->Estanteria_Id->EditCustomAttributes = "";
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
				$this->Estanteria_Id->EditValue = $rswrk->fields('DispFld');
				$rswrk->Close();
			} else {
				$this->Estanteria_Id->EditValue = $this->Estanteria_Id->CurrentValue;
			}
		} else {
			$this->Estanteria_Id->EditValue = NULL;
		}
		}
		$this->Estanteria_Id->ViewCustomAttributes = "";

		// Seccion_id
		$this->Seccion_id->EditAttrs["class"] = "form-control";
		$this->Seccion_id->EditCustomAttributes = "";
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
				$this->Seccion_id->EditValue = $rswrk->fields('DispFld');
				$rswrk->Close();
			} else {
				$this->Seccion_id->EditValue = $this->Seccion_id->CurrentValue;
			}
		} else {
			$this->Seccion_id->EditValue = NULL;
		}
		}
		$this->Seccion_id->ViewCustomAttributes = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->codigo_bodega->Exportable) $Doc->ExportCaption($this->codigo_bodega);
					if ($this->Estanteria_Id->Exportable) $Doc->ExportCaption($this->Estanteria_Id);
					if ($this->Seccion_id->Exportable) $Doc->ExportCaption($this->Seccion_id);
				} else {
					if ($this->codigo_bodega->Exportable) $Doc->ExportCaption($this->codigo_bodega);
					if ($this->Estanteria_Id->Exportable) $Doc->ExportCaption($this->Estanteria_Id);
					if ($this->Seccion_id->Exportable) $Doc->ExportCaption($this->Seccion_id);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->codigo_bodega->Exportable) $Doc->ExportField($this->codigo_bodega);
						if ($this->Estanteria_Id->Exportable) $Doc->ExportField($this->Estanteria_Id);
						if ($this->Seccion_id->Exportable) $Doc->ExportField($this->Seccion_id);
					} else {
						if ($this->codigo_bodega->Exportable) $Doc->ExportField($this->codigo_bodega);
						if ($this->Estanteria_Id->Exportable) $Doc->ExportField($this->Estanteria_Id);
						if ($this->Seccion_id->Exportable) $Doc->ExportField($this->Seccion_id);
					}
					$Doc->EndExportRow();
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
