<?php

// Global variable for table object
$_Users = NULL;

//
// Table class for _Users
//
class c_Users extends cTable {
	var $_UserID;
	var $UserName;
	var $Password;
	var $caduca_clave;
	var $dias_expira;
	var $fecha_exprira;
	var $fecha_ultima_expiro;
	var $actualizar;
	var $e_mail;
	var $nombre;
	var $estado_empleado;
	var $puesto;
	var $_login;
	var $Bloqueado;
	var $Intentos;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = '_Users';
		$this->TableName = '_Users';
		$this->TableType = 'TABLE';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4; // Page size (PHPExcel only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// UserID
		$this->_UserID = new cField('_Users', '_Users', 'x__UserID', 'UserID', '[UserID]', 'CAST([UserID] AS NVARCHAR)', 3, -1, FALSE, '[UserID]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->_UserID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['UserID'] = &$this->_UserID;

		// UserName
		$this->UserName = new cField('_Users', '_Users', 'x_UserName', 'UserName', '[UserName]', '[UserName]', 202, -1, FALSE, '[UserName]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['UserName'] = &$this->UserName;

		// Password
		$this->Password = new cField('_Users', '_Users', 'x_Password', 'Password', '[Password]', '[Password]', 202, -1, FALSE, '[Password]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['Password'] = &$this->Password;

		// caduca_clave
		$this->caduca_clave = new cField('_Users', '_Users', 'x_caduca_clave', 'caduca_clave', '[caduca_clave]', '[caduca_clave]', 129, -1, FALSE, '[caduca_clave]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['caduca_clave'] = &$this->caduca_clave;

		// dias_expira
		$this->dias_expira = new cField('_Users', '_Users', 'x_dias_expira', 'dias_expira', '[dias_expira]', 'CAST([dias_expira] AS NVARCHAR)', 2, -1, FALSE, '[dias_expira]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->dias_expira->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['dias_expira'] = &$this->dias_expira;

		// fecha_exprira
		$this->fecha_exprira = new cField('_Users', '_Users', 'x_fecha_exprira', 'fecha_exprira', '[fecha_exprira]', '(REPLACE(STR(DAY([fecha_exprira]),2,0),\' \',\'0\') + \'/\' + REPLACE(STR(MONTH([fecha_exprira]),2,0),\' \',\'0\') + \'/\' + STR(YEAR([fecha_exprira]),4,0))', 135, 7, FALSE, '[fecha_exprira]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fecha_exprira->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['fecha_exprira'] = &$this->fecha_exprira;

		// fecha_ultima_expiro
		$this->fecha_ultima_expiro = new cField('_Users', '_Users', 'x_fecha_ultima_expiro', 'fecha_ultima_expiro', '[fecha_ultima_expiro]', '(REPLACE(STR(DAY([fecha_ultima_expiro]),2,0),\' \',\'0\') + \'/\' + REPLACE(STR(MONTH([fecha_ultima_expiro]),2,0),\' \',\'0\') + \'/\' + STR(YEAR([fecha_ultima_expiro]),4,0))', 135, 7, FALSE, '[fecha_ultima_expiro]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fecha_ultima_expiro->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['fecha_ultima_expiro'] = &$this->fecha_ultima_expiro;

		// actualizar
		$this->actualizar = new cField('_Users', '_Users', 'x_actualizar', 'actualizar', '[actualizar]', '[actualizar]', 129, -1, FALSE, '[actualizar]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['actualizar'] = &$this->actualizar;

		// e_mail
		$this->e_mail = new cField('_Users', '_Users', 'x_e_mail', 'e_mail', '[e_mail]', '[e_mail]', 200, -1, FALSE, '[e_mail]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['e_mail'] = &$this->e_mail;

		// nombre
		$this->nombre = new cField('_Users', '_Users', 'x_nombre', 'nombre', '[nombre]', '[nombre]', 200, -1, FALSE, '[nombre]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nombre'] = &$this->nombre;

		// estado_empleado
		$this->estado_empleado = new cField('_Users', '_Users', 'x_estado_empleado', 'estado_empleado', '[estado_empleado]', '[estado_empleado]', 129, -1, FALSE, '[estado_empleado]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['estado_empleado'] = &$this->estado_empleado;

		// puesto
		$this->puesto = new cField('_Users', '_Users', 'x_puesto', 'puesto', '[puesto]', '[puesto]', 129, -1, FALSE, '[puesto]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['puesto'] = &$this->puesto;

		// login
		$this->_login = new cField('_Users', '_Users', 'x__login', 'login', '[login]', '[login]', 200, -1, FALSE, '[login]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['login'] = &$this->_login;

		// Bloqueado
		$this->Bloqueado = new cField('_Users', '_Users', 'x_Bloqueado', 'Bloqueado', '[Bloqueado]', '[Bloqueado]', 11, -1, FALSE, '[Bloqueado]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Bloqueado->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->fields['Bloqueado'] = &$this->Bloqueado;

		// Intentos
		$this->Intentos = new cField('_Users', '_Users', 'x_Intentos', 'Intentos', '[Intentos]', 'CAST([Intentos] AS NVARCHAR)', 17, -1, FALSE, '[Intentos]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Intentos->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Intentos'] = &$this->Intentos;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "[dbo].[_Users]";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
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
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
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
	var $UpdateTable = "[dbo].[_Users]";

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]))
				continue;
			if (EW_ENCRYPTED_PASSWORD && $name == 'Password')
				$value = (EW_CASE_SENSITIVE_PASSWORD) ? ew_EncryptPassword($value) : ew_EncryptPassword(strtolower($value));
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
			if (EW_ENCRYPTED_PASSWORD && $name == 'Password') {
				$value = (EW_CASE_SENSITIVE_PASSWORD) ? ew_EncryptPassword($value) : ew_EncryptPassword(strtolower($value));
			}
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
			if (array_key_exists('UserID', $rs))
				ew_AddFilter($where, ew_QuotedName('UserID') . '=' . ew_QuotedValue($rs['UserID'], $this->_UserID->FldDataType));
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
		return "[UserID] = @_UserID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->_UserID->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@_UserID@", ew_AdjustSql($this->_UserID->CurrentValue), $sKeyFilter); // Replace key value
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
			return "_Userslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "_Userslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("_Usersview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("_Usersview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "_Usersadd.php?" . $this->UrlParm($parm);
		else
			return "_Usersadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("_Usersedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("_Usersadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("_Usersdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->_UserID->CurrentValue)) {
			$sUrl .= "_UserID=" . urlencode($this->_UserID->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(141, 201, 203, 128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {
			$arKeys[] = @$_GET["_UserID"]; // UserID

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		foreach ($arKeys as $key) {
			if (!is_numeric($key))
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
			$this->_UserID->CurrentValue = $key;
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
		$this->_UserID->setDbValue($rs->fields('UserID'));
		$this->UserName->setDbValue($rs->fields('UserName'));
		$this->Password->setDbValue($rs->fields('Password'));
		$this->caduca_clave->setDbValue($rs->fields('caduca_clave'));
		$this->dias_expira->setDbValue($rs->fields('dias_expira'));
		$this->fecha_exprira->setDbValue($rs->fields('fecha_exprira'));
		$this->fecha_ultima_expiro->setDbValue($rs->fields('fecha_ultima_expiro'));
		$this->actualizar->setDbValue($rs->fields('actualizar'));
		$this->e_mail->setDbValue($rs->fields('e_mail'));
		$this->nombre->setDbValue($rs->fields('nombre'));
		$this->estado_empleado->setDbValue($rs->fields('estado_empleado'));
		$this->puesto->setDbValue($rs->fields('puesto'));
		$this->_login->setDbValue($rs->fields('login'));
		$this->Bloqueado->setDbValue((ew_ConvertToBool($rs->fields('Bloqueado'))) ? "1" : "0");
		$this->Intentos->setDbValue($rs->fields('Intentos'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// UserID
		// UserName
		// Password
		// caduca_clave
		// dias_expira
		// fecha_exprira
		// fecha_ultima_expiro
		// actualizar
		// e_mail
		// nombre
		// estado_empleado
		// puesto
		// login
		// Bloqueado
		// Intentos
		// UserID

		$this->_UserID->ViewValue = $this->_UserID->CurrentValue;
		$this->_UserID->ViewCustomAttributes = "";

		// UserName
		$this->UserName->ViewValue = $this->UserName->CurrentValue;
		$this->UserName->ViewCustomAttributes = "";

		// Password
		$this->Password->ViewValue = $this->Password->CurrentValue;
		$this->Password->ViewCustomAttributes = "";

		// caduca_clave
		$this->caduca_clave->ViewValue = $this->caduca_clave->CurrentValue;
		$this->caduca_clave->ViewCustomAttributes = "";

		// dias_expira
		$this->dias_expira->ViewValue = $this->dias_expira->CurrentValue;
		$this->dias_expira->ViewCustomAttributes = "";

		// fecha_exprira
		$this->fecha_exprira->ViewValue = $this->fecha_exprira->CurrentValue;
		$this->fecha_exprira->ViewValue = ew_FormatDateTime($this->fecha_exprira->ViewValue, 7);
		$this->fecha_exprira->ViewCustomAttributes = "";

		// fecha_ultima_expiro
		$this->fecha_ultima_expiro->ViewValue = $this->fecha_ultima_expiro->CurrentValue;
		$this->fecha_ultima_expiro->ViewValue = ew_FormatDateTime($this->fecha_ultima_expiro->ViewValue, 7);
		$this->fecha_ultima_expiro->ViewCustomAttributes = "";

		// actualizar
		$this->actualizar->ViewValue = $this->actualizar->CurrentValue;
		$this->actualizar->ViewCustomAttributes = "";

		// e_mail
		$this->e_mail->ViewValue = $this->e_mail->CurrentValue;
		$this->e_mail->ViewCustomAttributes = "";

		// nombre
		$this->nombre->ViewValue = $this->nombre->CurrentValue;
		$this->nombre->ViewCustomAttributes = "";

		// estado_empleado
		$this->estado_empleado->ViewValue = $this->estado_empleado->CurrentValue;
		$this->estado_empleado->ViewCustomAttributes = "";

		// puesto
		$this->puesto->ViewValue = $this->puesto->CurrentValue;
		$this->puesto->ViewCustomAttributes = "";

		// login
		$this->_login->ViewValue = $this->_login->CurrentValue;
		$this->_login->ViewCustomAttributes = "";

		// Bloqueado
		if (ew_ConvertToBool($this->Bloqueado->CurrentValue)) {
			$this->Bloqueado->ViewValue = $this->Bloqueado->FldTagCaption(1) <> "" ? $this->Bloqueado->FldTagCaption(1) : "Yes";
		} else {
			$this->Bloqueado->ViewValue = $this->Bloqueado->FldTagCaption(2) <> "" ? $this->Bloqueado->FldTagCaption(2) : "No";
		}
		$this->Bloqueado->ViewCustomAttributes = "";

		// Intentos
		$this->Intentos->ViewValue = $this->Intentos->CurrentValue;
		$this->Intentos->ViewCustomAttributes = "";

		// UserID
		$this->_UserID->LinkCustomAttributes = "";
		$this->_UserID->HrefValue = "";
		$this->_UserID->TooltipValue = "";

		// UserName
		$this->UserName->LinkCustomAttributes = "";
		$this->UserName->HrefValue = "";
		$this->UserName->TooltipValue = "";

		// Password
		$this->Password->LinkCustomAttributes = "";
		$this->Password->HrefValue = "";
		$this->Password->TooltipValue = "";

		// caduca_clave
		$this->caduca_clave->LinkCustomAttributes = "";
		$this->caduca_clave->HrefValue = "";
		$this->caduca_clave->TooltipValue = "";

		// dias_expira
		$this->dias_expira->LinkCustomAttributes = "";
		$this->dias_expira->HrefValue = "";
		$this->dias_expira->TooltipValue = "";

		// fecha_exprira
		$this->fecha_exprira->LinkCustomAttributes = "";
		$this->fecha_exprira->HrefValue = "";
		$this->fecha_exprira->TooltipValue = "";

		// fecha_ultima_expiro
		$this->fecha_ultima_expiro->LinkCustomAttributes = "";
		$this->fecha_ultima_expiro->HrefValue = "";
		$this->fecha_ultima_expiro->TooltipValue = "";

		// actualizar
		$this->actualizar->LinkCustomAttributes = "";
		$this->actualizar->HrefValue = "";
		$this->actualizar->TooltipValue = "";

		// e_mail
		$this->e_mail->LinkCustomAttributes = "";
		$this->e_mail->HrefValue = "";
		$this->e_mail->TooltipValue = "";

		// nombre
		$this->nombre->LinkCustomAttributes = "";
		$this->nombre->HrefValue = "";
		$this->nombre->TooltipValue = "";

		// estado_empleado
		$this->estado_empleado->LinkCustomAttributes = "";
		$this->estado_empleado->HrefValue = "";
		$this->estado_empleado->TooltipValue = "";

		// puesto
		$this->puesto->LinkCustomAttributes = "";
		$this->puesto->HrefValue = "";
		$this->puesto->TooltipValue = "";

		// login
		$this->_login->LinkCustomAttributes = "";
		$this->_login->HrefValue = "";
		$this->_login->TooltipValue = "";

		// Bloqueado
		$this->Bloqueado->LinkCustomAttributes = "";
		$this->Bloqueado->HrefValue = "";
		$this->Bloqueado->TooltipValue = "";

		// Intentos
		$this->Intentos->LinkCustomAttributes = "";
		$this->Intentos->HrefValue = "";
		$this->Intentos->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $conn, $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// UserID
		$this->_UserID->EditAttrs["class"] = "form-control";
		$this->_UserID->EditCustomAttributes = "";
		$this->_UserID->EditValue = $this->_UserID->CurrentValue;
		$this->_UserID->ViewCustomAttributes = "";

		// UserName
		$this->UserName->EditAttrs["class"] = "form-control";
		$this->UserName->EditCustomAttributes = "";
		$this->UserName->EditValue = ew_HtmlEncode($this->UserName->CurrentValue);
		$this->UserName->PlaceHolder = ew_RemoveHtml($this->UserName->FldCaption());

		// Password
		$this->Password->EditAttrs["class"] = "form-control";
		$this->Password->EditCustomAttributes = "";
		$this->Password->EditValue = ew_HtmlEncode($this->Password->CurrentValue);
		$this->Password->PlaceHolder = ew_RemoveHtml($this->Password->FldCaption());

		// caduca_clave
		$this->caduca_clave->EditAttrs["class"] = "form-control";
		$this->caduca_clave->EditCustomAttributes = "";
		$this->caduca_clave->EditValue = ew_HtmlEncode($this->caduca_clave->CurrentValue);
		$this->caduca_clave->PlaceHolder = ew_RemoveHtml($this->caduca_clave->FldCaption());

		// dias_expira
		$this->dias_expira->EditAttrs["class"] = "form-control";
		$this->dias_expira->EditCustomAttributes = "";
		$this->dias_expira->EditValue = ew_HtmlEncode($this->dias_expira->CurrentValue);
		$this->dias_expira->PlaceHolder = ew_RemoveHtml($this->dias_expira->FldCaption());

		// fecha_exprira
		$this->fecha_exprira->EditAttrs["class"] = "form-control";
		$this->fecha_exprira->EditCustomAttributes = "";
		$this->fecha_exprira->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_exprira->CurrentValue, 7));
		$this->fecha_exprira->PlaceHolder = ew_RemoveHtml($this->fecha_exprira->FldCaption());

		// fecha_ultima_expiro
		$this->fecha_ultima_expiro->EditAttrs["class"] = "form-control";
		$this->fecha_ultima_expiro->EditCustomAttributes = "";
		$this->fecha_ultima_expiro->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_ultima_expiro->CurrentValue, 7));
		$this->fecha_ultima_expiro->PlaceHolder = ew_RemoveHtml($this->fecha_ultima_expiro->FldCaption());

		// actualizar
		$this->actualizar->EditAttrs["class"] = "form-control";
		$this->actualizar->EditCustomAttributes = "";
		$this->actualizar->EditValue = ew_HtmlEncode($this->actualizar->CurrentValue);
		$this->actualizar->PlaceHolder = ew_RemoveHtml($this->actualizar->FldCaption());

		// e_mail
		$this->e_mail->EditAttrs["class"] = "form-control";
		$this->e_mail->EditCustomAttributes = "";
		$this->e_mail->EditValue = ew_HtmlEncode($this->e_mail->CurrentValue);
		$this->e_mail->PlaceHolder = ew_RemoveHtml($this->e_mail->FldCaption());

		// nombre
		$this->nombre->EditAttrs["class"] = "form-control";
		$this->nombre->EditCustomAttributes = "";
		$this->nombre->EditValue = ew_HtmlEncode($this->nombre->CurrentValue);
		$this->nombre->PlaceHolder = ew_RemoveHtml($this->nombre->FldCaption());

		// estado_empleado
		$this->estado_empleado->EditAttrs["class"] = "form-control";
		$this->estado_empleado->EditCustomAttributes = "";
		$this->estado_empleado->EditValue = ew_HtmlEncode($this->estado_empleado->CurrentValue);
		$this->estado_empleado->PlaceHolder = ew_RemoveHtml($this->estado_empleado->FldCaption());

		// puesto
		$this->puesto->EditAttrs["class"] = "form-control";
		$this->puesto->EditCustomAttributes = "";
		$this->puesto->EditValue = ew_HtmlEncode($this->puesto->CurrentValue);
		$this->puesto->PlaceHolder = ew_RemoveHtml($this->puesto->FldCaption());

		// login
		$this->_login->EditAttrs["class"] = "form-control";
		$this->_login->EditCustomAttributes = "";
		$this->_login->EditValue = ew_HtmlEncode($this->_login->CurrentValue);
		$this->_login->PlaceHolder = ew_RemoveHtml($this->_login->FldCaption());

		// Bloqueado
		$this->Bloqueado->EditCustomAttributes = "";
		$arwrk = array();
		$arwrk[] = array($this->Bloqueado->FldTagValue(1), $this->Bloqueado->FldTagCaption(1) <> "" ? $this->Bloqueado->FldTagCaption(1) : $this->Bloqueado->FldTagValue(1));
		$arwrk[] = array($this->Bloqueado->FldTagValue(2), $this->Bloqueado->FldTagCaption(2) <> "" ? $this->Bloqueado->FldTagCaption(2) : $this->Bloqueado->FldTagValue(2));
		$this->Bloqueado->EditValue = $arwrk;

		// Intentos
		$this->Intentos->EditAttrs["class"] = "form-control";
		$this->Intentos->EditCustomAttributes = "";
		$this->Intentos->EditValue = ew_HtmlEncode($this->Intentos->CurrentValue);
		$this->Intentos->PlaceHolder = ew_RemoveHtml($this->Intentos->FldCaption());

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
					if ($this->_UserID->Exportable) $Doc->ExportCaption($this->_UserID);
					if ($this->UserName->Exportable) $Doc->ExportCaption($this->UserName);
					if ($this->Password->Exportable) $Doc->ExportCaption($this->Password);
					if ($this->caduca_clave->Exportable) $Doc->ExportCaption($this->caduca_clave);
					if ($this->dias_expira->Exportable) $Doc->ExportCaption($this->dias_expira);
					if ($this->fecha_exprira->Exportable) $Doc->ExportCaption($this->fecha_exprira);
					if ($this->fecha_ultima_expiro->Exportable) $Doc->ExportCaption($this->fecha_ultima_expiro);
					if ($this->actualizar->Exportable) $Doc->ExportCaption($this->actualizar);
					if ($this->e_mail->Exportable) $Doc->ExportCaption($this->e_mail);
					if ($this->nombre->Exportable) $Doc->ExportCaption($this->nombre);
					if ($this->estado_empleado->Exportable) $Doc->ExportCaption($this->estado_empleado);
					if ($this->puesto->Exportable) $Doc->ExportCaption($this->puesto);
					if ($this->_login->Exportable) $Doc->ExportCaption($this->_login);
					if ($this->Bloqueado->Exportable) $Doc->ExportCaption($this->Bloqueado);
					if ($this->Intentos->Exportable) $Doc->ExportCaption($this->Intentos);
				} else {
					if ($this->_UserID->Exportable) $Doc->ExportCaption($this->_UserID);
					if ($this->UserName->Exportable) $Doc->ExportCaption($this->UserName);
					if ($this->Password->Exportable) $Doc->ExportCaption($this->Password);
					if ($this->caduca_clave->Exportable) $Doc->ExportCaption($this->caduca_clave);
					if ($this->dias_expira->Exportable) $Doc->ExportCaption($this->dias_expira);
					if ($this->fecha_exprira->Exportable) $Doc->ExportCaption($this->fecha_exprira);
					if ($this->fecha_ultima_expiro->Exportable) $Doc->ExportCaption($this->fecha_ultima_expiro);
					if ($this->actualizar->Exportable) $Doc->ExportCaption($this->actualizar);
					if ($this->e_mail->Exportable) $Doc->ExportCaption($this->e_mail);
					if ($this->nombre->Exportable) $Doc->ExportCaption($this->nombre);
					if ($this->estado_empleado->Exportable) $Doc->ExportCaption($this->estado_empleado);
					if ($this->puesto->Exportable) $Doc->ExportCaption($this->puesto);
					if ($this->_login->Exportable) $Doc->ExportCaption($this->_login);
					if ($this->Bloqueado->Exportable) $Doc->ExportCaption($this->Bloqueado);
					if ($this->Intentos->Exportable) $Doc->ExportCaption($this->Intentos);
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
						if ($this->_UserID->Exportable) $Doc->ExportField($this->_UserID);
						if ($this->UserName->Exportable) $Doc->ExportField($this->UserName);
						if ($this->Password->Exportable) $Doc->ExportField($this->Password);
						if ($this->caduca_clave->Exportable) $Doc->ExportField($this->caduca_clave);
						if ($this->dias_expira->Exportable) $Doc->ExportField($this->dias_expira);
						if ($this->fecha_exprira->Exportable) $Doc->ExportField($this->fecha_exprira);
						if ($this->fecha_ultima_expiro->Exportable) $Doc->ExportField($this->fecha_ultima_expiro);
						if ($this->actualizar->Exportable) $Doc->ExportField($this->actualizar);
						if ($this->e_mail->Exportable) $Doc->ExportField($this->e_mail);
						if ($this->nombre->Exportable) $Doc->ExportField($this->nombre);
						if ($this->estado_empleado->Exportable) $Doc->ExportField($this->estado_empleado);
						if ($this->puesto->Exportable) $Doc->ExportField($this->puesto);
						if ($this->_login->Exportable) $Doc->ExportField($this->_login);
						if ($this->Bloqueado->Exportable) $Doc->ExportField($this->Bloqueado);
						if ($this->Intentos->Exportable) $Doc->ExportField($this->Intentos);
					} else {
						if ($this->_UserID->Exportable) $Doc->ExportField($this->_UserID);
						if ($this->UserName->Exportable) $Doc->ExportField($this->UserName);
						if ($this->Password->Exportable) $Doc->ExportField($this->Password);
						if ($this->caduca_clave->Exportable) $Doc->ExportField($this->caduca_clave);
						if ($this->dias_expira->Exportable) $Doc->ExportField($this->dias_expira);
						if ($this->fecha_exprira->Exportable) $Doc->ExportField($this->fecha_exprira);
						if ($this->fecha_ultima_expiro->Exportable) $Doc->ExportField($this->fecha_ultima_expiro);
						if ($this->actualizar->Exportable) $Doc->ExportField($this->actualizar);
						if ($this->e_mail->Exportable) $Doc->ExportField($this->e_mail);
						if ($this->nombre->Exportable) $Doc->ExportField($this->nombre);
						if ($this->estado_empleado->Exportable) $Doc->ExportField($this->estado_empleado);
						if ($this->puesto->Exportable) $Doc->ExportField($this->puesto);
						if ($this->_login->Exportable) $Doc->ExportField($this->_login);
						if ($this->Bloqueado->Exportable) $Doc->ExportField($this->Bloqueado);
						if ($this->Intentos->Exportable) $Doc->ExportField($this->Intentos);
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
