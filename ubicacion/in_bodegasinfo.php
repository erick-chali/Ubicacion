<?php

// Global variable for table object
$in_bodegas = NULL;

//
// Table class for in_bodegas
//
class cin_bodegas extends cTable {
	var $codigo_bodega;
	var $descripcion;
	var $direccion;
	var $empleado_encargado;
	var $empleado_mensajes;
	var $es_abastecedora;
	var $no_traslado;
	var $negativos;
	var $dias_inventario;
	var $cuenta_contable;
	var $codigo_centro;
	var $cuenta_gastos;
	var $centro_gastos;
	var $no_ingreso;
	var $cuenta_costos;
	var $bodega_equivalente;
	var $factura;
	var $cuenta_gastos_locales;
	var $centro_gastos_locales;
	var $cuenta_otros_gastos;
	var $centro_otros_gastos;
	var $Pais;
	var $FECHA_ULTIMA_ACT;
	var $U_VLGX_LT;
	var $U_VLGX_VIV;
	var $ACEPTA_TRASLADOS;
	var $Activo;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'in_bodegas';
		$this->TableName = 'in_bodegas';
		$this->TableType = 'TABLE';
		$this->ExportAll = FALSE;
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
		$this->BasicSearch->TypeDefault = "OR";

		// codigo_bodega
		$this->codigo_bodega = new cField('in_bodegas', 'in_bodegas', 'x_codigo_bodega', 'codigo_bodega', '[codigo_bodega]', '[codigo_bodega]', 129, -1, FALSE, '[codigo_bodega]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['codigo_bodega'] = &$this->codigo_bodega;

		// descripcion
		$this->descripcion = new cField('in_bodegas', 'in_bodegas', 'x_descripcion', 'descripcion', '[descripcion]', '[descripcion]', 200, -1, FALSE, '[descripcion]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['descripcion'] = &$this->descripcion;

		// direccion
		$this->direccion = new cField('in_bodegas', 'in_bodegas', 'x_direccion', 'direccion', '[direccion]', '[direccion]', 200, -1, FALSE, '[direccion]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['direccion'] = &$this->direccion;

		// empleado_encargado
		$this->empleado_encargado = new cField('in_bodegas', 'in_bodegas', 'x_empleado_encargado', 'empleado_encargado', '[empleado_encargado]', 'CAST([empleado_encargado] AS NVARCHAR)', 2, -1, FALSE, '[empleado_encargado]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->empleado_encargado->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['empleado_encargado'] = &$this->empleado_encargado;

		// empleado_mensajes
		$this->empleado_mensajes = new cField('in_bodegas', 'in_bodegas', 'x_empleado_mensajes', 'empleado_mensajes', '[empleado_mensajes]', 'CAST([empleado_mensajes] AS NVARCHAR)', 2, -1, FALSE, '[empleado_mensajes]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->empleado_mensajes->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['empleado_mensajes'] = &$this->empleado_mensajes;

		// es_abastecedora
		$this->es_abastecedora = new cField('in_bodegas', 'in_bodegas', 'x_es_abastecedora', 'es_abastecedora', '[es_abastecedora]', '[es_abastecedora]', 129, -1, FALSE, '[es_abastecedora]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['es_abastecedora'] = &$this->es_abastecedora;

		// no_traslado
		$this->no_traslado = new cField('in_bodegas', 'in_bodegas', 'x_no_traslado', 'no_traslado', '[no_traslado]', 'CAST([no_traslado] AS NVARCHAR)', 3, -1, FALSE, '[no_traslado]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->no_traslado->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['no_traslado'] = &$this->no_traslado;

		// negativos
		$this->negativos = new cField('in_bodegas', 'in_bodegas', 'x_negativos', 'negativos', '[negativos]', '[negativos]', 129, -1, FALSE, '[negativos]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['negativos'] = &$this->negativos;

		// dias_inventario
		$this->dias_inventario = new cField('in_bodegas', 'in_bodegas', 'x_dias_inventario', 'dias_inventario', '[dias_inventario]', 'CAST([dias_inventario] AS NVARCHAR)', 2, -1, FALSE, '[dias_inventario]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->dias_inventario->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['dias_inventario'] = &$this->dias_inventario;

		// cuenta_contable
		$this->cuenta_contable = new cField('in_bodegas', 'in_bodegas', 'x_cuenta_contable', 'cuenta_contable', '[cuenta_contable]', '[cuenta_contable]', 200, -1, FALSE, '[cuenta_contable]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['cuenta_contable'] = &$this->cuenta_contable;

		// codigo_centro
		$this->codigo_centro = new cField('in_bodegas', 'in_bodegas', 'x_codigo_centro', 'codigo_centro', '[codigo_centro]', '[codigo_centro]', 200, -1, FALSE, '[codigo_centro]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['codigo_centro'] = &$this->codigo_centro;

		// cuenta_gastos
		$this->cuenta_gastos = new cField('in_bodegas', 'in_bodegas', 'x_cuenta_gastos', 'cuenta_gastos', '[cuenta_gastos]', '[cuenta_gastos]', 200, -1, FALSE, '[cuenta_gastos]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['cuenta_gastos'] = &$this->cuenta_gastos;

		// centro_gastos
		$this->centro_gastos = new cField('in_bodegas', 'in_bodegas', 'x_centro_gastos', 'centro_gastos', '[centro_gastos]', '[centro_gastos]', 200, -1, FALSE, '[centro_gastos]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['centro_gastos'] = &$this->centro_gastos;

		// no_ingreso
		$this->no_ingreso = new cField('in_bodegas', 'in_bodegas', 'x_no_ingreso', 'no_ingreso', '[no_ingreso]', 'CAST([no_ingreso] AS NVARCHAR)', 3, -1, FALSE, '[no_ingreso]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->no_ingreso->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['no_ingreso'] = &$this->no_ingreso;

		// cuenta_costos
		$this->cuenta_costos = new cField('in_bodegas', 'in_bodegas', 'x_cuenta_costos', 'cuenta_costos', '[cuenta_costos]', '[cuenta_costos]', 200, -1, FALSE, '[cuenta_costos]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['cuenta_costos'] = &$this->cuenta_costos;

		// bodega_equivalente
		$this->bodega_equivalente = new cField('in_bodegas', 'in_bodegas', 'x_bodega_equivalente', 'bodega_equivalente', '[bodega_equivalente]', '[bodega_equivalente]', 129, -1, FALSE, '[bodega_equivalente]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['bodega_equivalente'] = &$this->bodega_equivalente;

		// factura
		$this->factura = new cField('in_bodegas', 'in_bodegas', 'x_factura', 'factura', '[factura]', '[factura]', 129, -1, FALSE, '[factura]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['factura'] = &$this->factura;

		// cuenta_gastos_locales
		$this->cuenta_gastos_locales = new cField('in_bodegas', 'in_bodegas', 'x_cuenta_gastos_locales', 'cuenta_gastos_locales', '[cuenta_gastos_locales]', '[cuenta_gastos_locales]', 200, -1, FALSE, '[cuenta_gastos_locales]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['cuenta_gastos_locales'] = &$this->cuenta_gastos_locales;

		// centro_gastos_locales
		$this->centro_gastos_locales = new cField('in_bodegas', 'in_bodegas', 'x_centro_gastos_locales', 'centro_gastos_locales', '[centro_gastos_locales]', '[centro_gastos_locales]', 200, -1, FALSE, '[centro_gastos_locales]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['centro_gastos_locales'] = &$this->centro_gastos_locales;

		// cuenta_otros_gastos
		$this->cuenta_otros_gastos = new cField('in_bodegas', 'in_bodegas', 'x_cuenta_otros_gastos', 'cuenta_otros_gastos', '[cuenta_otros_gastos]', '[cuenta_otros_gastos]', 200, -1, FALSE, '[cuenta_otros_gastos]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['cuenta_otros_gastos'] = &$this->cuenta_otros_gastos;

		// centro_otros_gastos
		$this->centro_otros_gastos = new cField('in_bodegas', 'in_bodegas', 'x_centro_otros_gastos', 'centro_otros_gastos', '[centro_otros_gastos]', '[centro_otros_gastos]', 200, -1, FALSE, '[centro_otros_gastos]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['centro_otros_gastos'] = &$this->centro_otros_gastos;

		// Pais
		$this->Pais = new cField('in_bodegas', 'in_bodegas', 'x_Pais', 'Pais', '[Pais]', '[Pais]', 130, -1, FALSE, '[Pais]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['Pais'] = &$this->Pais;

		// FECHA_ULTIMA_ACT
		$this->FECHA_ULTIMA_ACT = new cField('in_bodegas', 'in_bodegas', 'x_FECHA_ULTIMA_ACT', 'FECHA_ULTIMA_ACT', '[FECHA_ULTIMA_ACT]', '(REPLACE(STR(DAY([FECHA_ULTIMA_ACT]),2,0),\' \',\'0\') + \'/\' + REPLACE(STR(MONTH([FECHA_ULTIMA_ACT]),2,0),\' \',\'0\') + \'/\' + STR(YEAR([FECHA_ULTIMA_ACT]),4,0))', 135, 7, FALSE, '[FECHA_ULTIMA_ACT]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->FECHA_ULTIMA_ACT->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['FECHA_ULTIMA_ACT'] = &$this->FECHA_ULTIMA_ACT;

		// U_VLGX_LT
		$this->U_VLGX_LT = new cField('in_bodegas', 'in_bodegas', 'x_U_VLGX_LT', 'U_VLGX_LT', '[U_VLGX_LT]', 'CAST([U_VLGX_LT] AS NVARCHAR)', 3, -1, FALSE, '[U_VLGX_LT]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->U_VLGX_LT->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['U_VLGX_LT'] = &$this->U_VLGX_LT;

		// U_VLGX_VIV
		$this->U_VLGX_VIV = new cField('in_bodegas', 'in_bodegas', 'x_U_VLGX_VIV', 'U_VLGX_VIV', '[U_VLGX_VIV]', '[U_VLGX_VIV]', 200, -1, FALSE, '[U_VLGX_VIV]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['U_VLGX_VIV'] = &$this->U_VLGX_VIV;

		// ACEPTA_TRASLADOS
		$this->ACEPTA_TRASLADOS = new cField('in_bodegas', 'in_bodegas', 'x_ACEPTA_TRASLADOS', 'ACEPTA_TRASLADOS', '[ACEPTA_TRASLADOS]', '[ACEPTA_TRASLADOS]', 200, -1, FALSE, '[ACEPTA_TRASLADOS]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['ACEPTA_TRASLADOS'] = &$this->ACEPTA_TRASLADOS;

		// Activo
		$this->Activo = new cField('in_bodegas', 'in_bodegas', 'x_Activo', 'Activo', '[Activo]', '[Activo]', 11, -1, FALSE, '[Activo]', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Activo->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->fields['Activo'] = &$this->Activo;
	}

	// Current detail table name
	function getCurrentDetailTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE];
	}

	function setCurrentDetailTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	function GetDetailUrl() {

		// Detail url
		$sDetailUrl = "";
		if ($this->getCurrentDetailTable() == "in_bodegaubicaciones") {
			$sDetailUrl = $GLOBALS["in_bodegaubicaciones"]->GetListUrl() . "?showmaster=" . $this->TableVar;
			$sDetailUrl .= "&fk_codigo_bodega=" . urlencode($this->codigo_bodega->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "in_bodegaslist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "[dbo].[in_bodegas]";
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
	var $UpdateTable = "[dbo].[in_bodegas]";

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
		return "[codigo_bodega] = '@codigo_bodega@'";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@codigo_bodega@", ew_AdjustSql($this->codigo_bodega->CurrentValue), $sKeyFilter); // Replace key value
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
			return "in_bodegaslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "in_bodegaslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("in_bodegasview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("in_bodegasview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "in_bodegasadd.php?" . $this->UrlParm($parm);
		else
			return "in_bodegasadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("in_bodegasedit.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("in_bodegasedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("in_bodegasadd.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("in_bodegasadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("in_bodegasdelete.php", $this->UrlParm());
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
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {
			$arKeys[] = @$_GET["codigo_bodega"]; // codigo_bodega

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		foreach ($arKeys as $key) {
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
			$this->codigo_bodega->CurrentValue = $key;
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
		$this->descripcion->setDbValue($rs->fields('descripcion'));
		$this->direccion->setDbValue($rs->fields('direccion'));
		$this->empleado_encargado->setDbValue($rs->fields('empleado_encargado'));
		$this->empleado_mensajes->setDbValue($rs->fields('empleado_mensajes'));
		$this->es_abastecedora->setDbValue($rs->fields('es_abastecedora'));
		$this->no_traslado->setDbValue($rs->fields('no_traslado'));
		$this->negativos->setDbValue($rs->fields('negativos'));
		$this->dias_inventario->setDbValue($rs->fields('dias_inventario'));
		$this->cuenta_contable->setDbValue($rs->fields('cuenta_contable'));
		$this->codigo_centro->setDbValue($rs->fields('codigo_centro'));
		$this->cuenta_gastos->setDbValue($rs->fields('cuenta_gastos'));
		$this->centro_gastos->setDbValue($rs->fields('centro_gastos'));
		$this->no_ingreso->setDbValue($rs->fields('no_ingreso'));
		$this->cuenta_costos->setDbValue($rs->fields('cuenta_costos'));
		$this->bodega_equivalente->setDbValue($rs->fields('bodega_equivalente'));
		$this->factura->setDbValue($rs->fields('factura'));
		$this->cuenta_gastos_locales->setDbValue($rs->fields('cuenta_gastos_locales'));
		$this->centro_gastos_locales->setDbValue($rs->fields('centro_gastos_locales'));
		$this->cuenta_otros_gastos->setDbValue($rs->fields('cuenta_otros_gastos'));
		$this->centro_otros_gastos->setDbValue($rs->fields('centro_otros_gastos'));
		$this->Pais->setDbValue($rs->fields('Pais'));
		$this->FECHA_ULTIMA_ACT->setDbValue($rs->fields('FECHA_ULTIMA_ACT'));
		$this->U_VLGX_LT->setDbValue($rs->fields('U_VLGX_LT'));
		$this->U_VLGX_VIV->setDbValue($rs->fields('U_VLGX_VIV'));
		$this->ACEPTA_TRASLADOS->setDbValue($rs->fields('ACEPTA_TRASLADOS'));
		$this->Activo->setDbValue((ew_ConvertToBool($rs->fields('Activo'))) ? "1" : "0");
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// codigo_bodega
		// descripcion
		// direccion
		// empleado_encargado
		// empleado_mensajes
		// es_abastecedora
		// no_traslado
		// negativos
		// dias_inventario
		// cuenta_contable
		// codigo_centro
		// cuenta_gastos
		// centro_gastos
		// no_ingreso
		// cuenta_costos
		// bodega_equivalente
		// factura
		// cuenta_gastos_locales
		// centro_gastos_locales
		// cuenta_otros_gastos
		// centro_otros_gastos
		// Pais
		// FECHA_ULTIMA_ACT
		// U_VLGX_LT
		// U_VLGX_VIV
		// ACEPTA_TRASLADOS
		// Activo
		// codigo_bodega

		$this->codigo_bodega->ViewValue = $this->codigo_bodega->CurrentValue;
		$this->codigo_bodega->ViewCustomAttributes = "";

		// descripcion
		$this->descripcion->ViewValue = $this->descripcion->CurrentValue;
		$this->descripcion->ViewCustomAttributes = "";

		// direccion
		$this->direccion->ViewValue = $this->direccion->CurrentValue;
		$this->direccion->ViewCustomAttributes = "";

		// empleado_encargado
		$this->empleado_encargado->ViewValue = $this->empleado_encargado->CurrentValue;
		$this->empleado_encargado->ViewCustomAttributes = "";

		// empleado_mensajes
		$this->empleado_mensajes->ViewValue = $this->empleado_mensajes->CurrentValue;
		$this->empleado_mensajes->ViewCustomAttributes = "";

		// es_abastecedora
		$this->es_abastecedora->ViewValue = $this->es_abastecedora->CurrentValue;
		$this->es_abastecedora->ViewCustomAttributes = "";

		// no_traslado
		$this->no_traslado->ViewValue = $this->no_traslado->CurrentValue;
		$this->no_traslado->ViewCustomAttributes = "";

		// negativos
		$this->negativos->ViewValue = $this->negativos->CurrentValue;
		$this->negativos->ViewCustomAttributes = "";

		// dias_inventario
		$this->dias_inventario->ViewValue = $this->dias_inventario->CurrentValue;
		$this->dias_inventario->ViewCustomAttributes = "";

		// cuenta_contable
		$this->cuenta_contable->ViewValue = $this->cuenta_contable->CurrentValue;
		$this->cuenta_contable->ViewCustomAttributes = "";

		// codigo_centro
		$this->codigo_centro->ViewValue = $this->codigo_centro->CurrentValue;
		$this->codigo_centro->ViewCustomAttributes = "";

		// cuenta_gastos
		$this->cuenta_gastos->ViewValue = $this->cuenta_gastos->CurrentValue;
		$this->cuenta_gastos->ViewCustomAttributes = "";

		// centro_gastos
		$this->centro_gastos->ViewValue = $this->centro_gastos->CurrentValue;
		$this->centro_gastos->ViewCustomAttributes = "";

		// no_ingreso
		$this->no_ingreso->ViewValue = $this->no_ingreso->CurrentValue;
		$this->no_ingreso->ViewCustomAttributes = "";

		// cuenta_costos
		$this->cuenta_costos->ViewValue = $this->cuenta_costos->CurrentValue;
		$this->cuenta_costos->ViewCustomAttributes = "";

		// bodega_equivalente
		$this->bodega_equivalente->ViewValue = $this->bodega_equivalente->CurrentValue;
		$this->bodega_equivalente->ViewCustomAttributes = "";

		// factura
		$this->factura->ViewValue = $this->factura->CurrentValue;
		$this->factura->ViewCustomAttributes = "";

		// cuenta_gastos_locales
		$this->cuenta_gastos_locales->ViewValue = $this->cuenta_gastos_locales->CurrentValue;
		$this->cuenta_gastos_locales->ViewCustomAttributes = "";

		// centro_gastos_locales
		$this->centro_gastos_locales->ViewValue = $this->centro_gastos_locales->CurrentValue;
		$this->centro_gastos_locales->ViewCustomAttributes = "";

		// cuenta_otros_gastos
		$this->cuenta_otros_gastos->ViewValue = $this->cuenta_otros_gastos->CurrentValue;
		$this->cuenta_otros_gastos->ViewCustomAttributes = "";

		// centro_otros_gastos
		$this->centro_otros_gastos->ViewValue = $this->centro_otros_gastos->CurrentValue;
		$this->centro_otros_gastos->ViewCustomAttributes = "";

		// Pais
		$this->Pais->ViewValue = $this->Pais->CurrentValue;
		$this->Pais->ViewCustomAttributes = "";

		// FECHA_ULTIMA_ACT
		$this->FECHA_ULTIMA_ACT->ViewValue = $this->FECHA_ULTIMA_ACT->CurrentValue;
		$this->FECHA_ULTIMA_ACT->ViewValue = ew_FormatDateTime($this->FECHA_ULTIMA_ACT->ViewValue, 7);
		$this->FECHA_ULTIMA_ACT->ViewCustomAttributes = "";

		// U_VLGX_LT
		$this->U_VLGX_LT->ViewValue = $this->U_VLGX_LT->CurrentValue;
		$this->U_VLGX_LT->ViewCustomAttributes = "";

		// U_VLGX_VIV
		$this->U_VLGX_VIV->ViewValue = $this->U_VLGX_VIV->CurrentValue;
		$this->U_VLGX_VIV->ViewCustomAttributes = "";

		// ACEPTA_TRASLADOS
		$this->ACEPTA_TRASLADOS->ViewValue = $this->ACEPTA_TRASLADOS->CurrentValue;
		$this->ACEPTA_TRASLADOS->ViewCustomAttributes = "";

		// Activo
		if (ew_ConvertToBool($this->Activo->CurrentValue)) {
			$this->Activo->ViewValue = $this->Activo->FldTagCaption(1) <> "" ? $this->Activo->FldTagCaption(1) : "Yes";
		} else {
			$this->Activo->ViewValue = $this->Activo->FldTagCaption(2) <> "" ? $this->Activo->FldTagCaption(2) : "No";
		}
		$this->Activo->ViewCustomAttributes = "";

		// codigo_bodega
		$this->codigo_bodega->LinkCustomAttributes = "";
		$this->codigo_bodega->HrefValue = "";
		$this->codigo_bodega->TooltipValue = "";

		// descripcion
		$this->descripcion->LinkCustomAttributes = "";
		$this->descripcion->HrefValue = "";
		$this->descripcion->TooltipValue = "";

		// direccion
		$this->direccion->LinkCustomAttributes = "";
		$this->direccion->HrefValue = "";
		$this->direccion->TooltipValue = "";

		// empleado_encargado
		$this->empleado_encargado->LinkCustomAttributes = "";
		$this->empleado_encargado->HrefValue = "";
		$this->empleado_encargado->TooltipValue = "";

		// empleado_mensajes
		$this->empleado_mensajes->LinkCustomAttributes = "";
		$this->empleado_mensajes->HrefValue = "";
		$this->empleado_mensajes->TooltipValue = "";

		// es_abastecedora
		$this->es_abastecedora->LinkCustomAttributes = "";
		$this->es_abastecedora->HrefValue = "";
		$this->es_abastecedora->TooltipValue = "";

		// no_traslado
		$this->no_traslado->LinkCustomAttributes = "";
		$this->no_traslado->HrefValue = "";
		$this->no_traslado->TooltipValue = "";

		// negativos
		$this->negativos->LinkCustomAttributes = "";
		$this->negativos->HrefValue = "";
		$this->negativos->TooltipValue = "";

		// dias_inventario
		$this->dias_inventario->LinkCustomAttributes = "";
		$this->dias_inventario->HrefValue = "";
		$this->dias_inventario->TooltipValue = "";

		// cuenta_contable
		$this->cuenta_contable->LinkCustomAttributes = "";
		$this->cuenta_contable->HrefValue = "";
		$this->cuenta_contable->TooltipValue = "";

		// codigo_centro
		$this->codigo_centro->LinkCustomAttributes = "";
		$this->codigo_centro->HrefValue = "";
		$this->codigo_centro->TooltipValue = "";

		// cuenta_gastos
		$this->cuenta_gastos->LinkCustomAttributes = "";
		$this->cuenta_gastos->HrefValue = "";
		$this->cuenta_gastos->TooltipValue = "";

		// centro_gastos
		$this->centro_gastos->LinkCustomAttributes = "";
		$this->centro_gastos->HrefValue = "";
		$this->centro_gastos->TooltipValue = "";

		// no_ingreso
		$this->no_ingreso->LinkCustomAttributes = "";
		$this->no_ingreso->HrefValue = "";
		$this->no_ingreso->TooltipValue = "";

		// cuenta_costos
		$this->cuenta_costos->LinkCustomAttributes = "";
		$this->cuenta_costos->HrefValue = "";
		$this->cuenta_costos->TooltipValue = "";

		// bodega_equivalente
		$this->bodega_equivalente->LinkCustomAttributes = "";
		$this->bodega_equivalente->HrefValue = "";
		$this->bodega_equivalente->TooltipValue = "";

		// factura
		$this->factura->LinkCustomAttributes = "";
		$this->factura->HrefValue = "";
		$this->factura->TooltipValue = "";

		// cuenta_gastos_locales
		$this->cuenta_gastos_locales->LinkCustomAttributes = "";
		$this->cuenta_gastos_locales->HrefValue = "";
		$this->cuenta_gastos_locales->TooltipValue = "";

		// centro_gastos_locales
		$this->centro_gastos_locales->LinkCustomAttributes = "";
		$this->centro_gastos_locales->HrefValue = "";
		$this->centro_gastos_locales->TooltipValue = "";

		// cuenta_otros_gastos
		$this->cuenta_otros_gastos->LinkCustomAttributes = "";
		$this->cuenta_otros_gastos->HrefValue = "";
		$this->cuenta_otros_gastos->TooltipValue = "";

		// centro_otros_gastos
		$this->centro_otros_gastos->LinkCustomAttributes = "";
		$this->centro_otros_gastos->HrefValue = "";
		$this->centro_otros_gastos->TooltipValue = "";

		// Pais
		$this->Pais->LinkCustomAttributes = "";
		$this->Pais->HrefValue = "";
		$this->Pais->TooltipValue = "";

		// FECHA_ULTIMA_ACT
		$this->FECHA_ULTIMA_ACT->LinkCustomAttributes = "";
		$this->FECHA_ULTIMA_ACT->HrefValue = "";
		$this->FECHA_ULTIMA_ACT->TooltipValue = "";

		// U_VLGX_LT
		$this->U_VLGX_LT->LinkCustomAttributes = "";
		$this->U_VLGX_LT->HrefValue = "";
		$this->U_VLGX_LT->TooltipValue = "";

		// U_VLGX_VIV
		$this->U_VLGX_VIV->LinkCustomAttributes = "";
		$this->U_VLGX_VIV->HrefValue = "";
		$this->U_VLGX_VIV->TooltipValue = "";

		// ACEPTA_TRASLADOS
		$this->ACEPTA_TRASLADOS->LinkCustomAttributes = "";
		$this->ACEPTA_TRASLADOS->HrefValue = "";
		$this->ACEPTA_TRASLADOS->TooltipValue = "";

		// Activo
		$this->Activo->LinkCustomAttributes = "";
		$this->Activo->HrefValue = "";
		$this->Activo->TooltipValue = "";

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

		// descripcion
		$this->descripcion->EditAttrs["class"] = "form-control";
		$this->descripcion->EditCustomAttributes = "";
		$this->descripcion->EditValue = ew_HtmlEncode($this->descripcion->CurrentValue);
		$this->descripcion->PlaceHolder = ew_RemoveHtml($this->descripcion->FldCaption());

		// direccion
		$this->direccion->EditAttrs["class"] = "form-control";
		$this->direccion->EditCustomAttributes = "";
		$this->direccion->EditValue = ew_HtmlEncode($this->direccion->CurrentValue);
		$this->direccion->PlaceHolder = ew_RemoveHtml($this->direccion->FldCaption());

		// empleado_encargado
		$this->empleado_encargado->EditAttrs["class"] = "form-control";
		$this->empleado_encargado->EditCustomAttributes = "";
		$this->empleado_encargado->EditValue = ew_HtmlEncode($this->empleado_encargado->CurrentValue);
		$this->empleado_encargado->PlaceHolder = ew_RemoveHtml($this->empleado_encargado->FldCaption());

		// empleado_mensajes
		$this->empleado_mensajes->EditAttrs["class"] = "form-control";
		$this->empleado_mensajes->EditCustomAttributes = "";
		$this->empleado_mensajes->EditValue = ew_HtmlEncode($this->empleado_mensajes->CurrentValue);
		$this->empleado_mensajes->PlaceHolder = ew_RemoveHtml($this->empleado_mensajes->FldCaption());

		// es_abastecedora
		$this->es_abastecedora->EditAttrs["class"] = "form-control";
		$this->es_abastecedora->EditCustomAttributes = "";
		$this->es_abastecedora->EditValue = ew_HtmlEncode($this->es_abastecedora->CurrentValue);
		$this->es_abastecedora->PlaceHolder = ew_RemoveHtml($this->es_abastecedora->FldCaption());

		// no_traslado
		$this->no_traslado->EditAttrs["class"] = "form-control";
		$this->no_traslado->EditCustomAttributes = "";
		$this->no_traslado->EditValue = ew_HtmlEncode($this->no_traslado->CurrentValue);
		$this->no_traslado->PlaceHolder = ew_RemoveHtml($this->no_traslado->FldCaption());

		// negativos
		$this->negativos->EditAttrs["class"] = "form-control";
		$this->negativos->EditCustomAttributes = "";
		$this->negativos->EditValue = ew_HtmlEncode($this->negativos->CurrentValue);
		$this->negativos->PlaceHolder = ew_RemoveHtml($this->negativos->FldCaption());

		// dias_inventario
		$this->dias_inventario->EditAttrs["class"] = "form-control";
		$this->dias_inventario->EditCustomAttributes = "";
		$this->dias_inventario->EditValue = ew_HtmlEncode($this->dias_inventario->CurrentValue);
		$this->dias_inventario->PlaceHolder = ew_RemoveHtml($this->dias_inventario->FldCaption());

		// cuenta_contable
		$this->cuenta_contable->EditAttrs["class"] = "form-control";
		$this->cuenta_contable->EditCustomAttributes = "";
		$this->cuenta_contable->EditValue = ew_HtmlEncode($this->cuenta_contable->CurrentValue);
		$this->cuenta_contable->PlaceHolder = ew_RemoveHtml($this->cuenta_contable->FldCaption());

		// codigo_centro
		$this->codigo_centro->EditAttrs["class"] = "form-control";
		$this->codigo_centro->EditCustomAttributes = "";
		$this->codigo_centro->EditValue = ew_HtmlEncode($this->codigo_centro->CurrentValue);
		$this->codigo_centro->PlaceHolder = ew_RemoveHtml($this->codigo_centro->FldCaption());

		// cuenta_gastos
		$this->cuenta_gastos->EditAttrs["class"] = "form-control";
		$this->cuenta_gastos->EditCustomAttributes = "";
		$this->cuenta_gastos->EditValue = ew_HtmlEncode($this->cuenta_gastos->CurrentValue);
		$this->cuenta_gastos->PlaceHolder = ew_RemoveHtml($this->cuenta_gastos->FldCaption());

		// centro_gastos
		$this->centro_gastos->EditAttrs["class"] = "form-control";
		$this->centro_gastos->EditCustomAttributes = "";
		$this->centro_gastos->EditValue = ew_HtmlEncode($this->centro_gastos->CurrentValue);
		$this->centro_gastos->PlaceHolder = ew_RemoveHtml($this->centro_gastos->FldCaption());

		// no_ingreso
		$this->no_ingreso->EditAttrs["class"] = "form-control";
		$this->no_ingreso->EditCustomAttributes = "";
		$this->no_ingreso->EditValue = ew_HtmlEncode($this->no_ingreso->CurrentValue);
		$this->no_ingreso->PlaceHolder = ew_RemoveHtml($this->no_ingreso->FldCaption());

		// cuenta_costos
		$this->cuenta_costos->EditAttrs["class"] = "form-control";
		$this->cuenta_costos->EditCustomAttributes = "";
		$this->cuenta_costos->EditValue = ew_HtmlEncode($this->cuenta_costos->CurrentValue);
		$this->cuenta_costos->PlaceHolder = ew_RemoveHtml($this->cuenta_costos->FldCaption());

		// bodega_equivalente
		$this->bodega_equivalente->EditAttrs["class"] = "form-control";
		$this->bodega_equivalente->EditCustomAttributes = "";
		$this->bodega_equivalente->EditValue = ew_HtmlEncode($this->bodega_equivalente->CurrentValue);
		$this->bodega_equivalente->PlaceHolder = ew_RemoveHtml($this->bodega_equivalente->FldCaption());

		// factura
		$this->factura->EditAttrs["class"] = "form-control";
		$this->factura->EditCustomAttributes = "";
		$this->factura->EditValue = ew_HtmlEncode($this->factura->CurrentValue);
		$this->factura->PlaceHolder = ew_RemoveHtml($this->factura->FldCaption());

		// cuenta_gastos_locales
		$this->cuenta_gastos_locales->EditAttrs["class"] = "form-control";
		$this->cuenta_gastos_locales->EditCustomAttributes = "";
		$this->cuenta_gastos_locales->EditValue = ew_HtmlEncode($this->cuenta_gastos_locales->CurrentValue);
		$this->cuenta_gastos_locales->PlaceHolder = ew_RemoveHtml($this->cuenta_gastos_locales->FldCaption());

		// centro_gastos_locales
		$this->centro_gastos_locales->EditAttrs["class"] = "form-control";
		$this->centro_gastos_locales->EditCustomAttributes = "";
		$this->centro_gastos_locales->EditValue = ew_HtmlEncode($this->centro_gastos_locales->CurrentValue);
		$this->centro_gastos_locales->PlaceHolder = ew_RemoveHtml($this->centro_gastos_locales->FldCaption());

		// cuenta_otros_gastos
		$this->cuenta_otros_gastos->EditAttrs["class"] = "form-control";
		$this->cuenta_otros_gastos->EditCustomAttributes = "";
		$this->cuenta_otros_gastos->EditValue = ew_HtmlEncode($this->cuenta_otros_gastos->CurrentValue);
		$this->cuenta_otros_gastos->PlaceHolder = ew_RemoveHtml($this->cuenta_otros_gastos->FldCaption());

		// centro_otros_gastos
		$this->centro_otros_gastos->EditAttrs["class"] = "form-control";
		$this->centro_otros_gastos->EditCustomAttributes = "";
		$this->centro_otros_gastos->EditValue = ew_HtmlEncode($this->centro_otros_gastos->CurrentValue);
		$this->centro_otros_gastos->PlaceHolder = ew_RemoveHtml($this->centro_otros_gastos->FldCaption());

		// Pais
		$this->Pais->EditAttrs["class"] = "form-control";
		$this->Pais->EditCustomAttributes = "";
		$this->Pais->EditValue = ew_HtmlEncode($this->Pais->CurrentValue);
		$this->Pais->PlaceHolder = ew_RemoveHtml($this->Pais->FldCaption());

		// FECHA_ULTIMA_ACT
		$this->FECHA_ULTIMA_ACT->EditAttrs["class"] = "form-control";
		$this->FECHA_ULTIMA_ACT->EditCustomAttributes = "";
		$this->FECHA_ULTIMA_ACT->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->FECHA_ULTIMA_ACT->CurrentValue, 7));
		$this->FECHA_ULTIMA_ACT->PlaceHolder = ew_RemoveHtml($this->FECHA_ULTIMA_ACT->FldCaption());

		// U_VLGX_LT
		$this->U_VLGX_LT->EditAttrs["class"] = "form-control";
		$this->U_VLGX_LT->EditCustomAttributes = "";
		$this->U_VLGX_LT->EditValue = ew_HtmlEncode($this->U_VLGX_LT->CurrentValue);
		$this->U_VLGX_LT->PlaceHolder = ew_RemoveHtml($this->U_VLGX_LT->FldCaption());

		// U_VLGX_VIV
		$this->U_VLGX_VIV->EditAttrs["class"] = "form-control";
		$this->U_VLGX_VIV->EditCustomAttributes = "";
		$this->U_VLGX_VIV->EditValue = ew_HtmlEncode($this->U_VLGX_VIV->CurrentValue);
		$this->U_VLGX_VIV->PlaceHolder = ew_RemoveHtml($this->U_VLGX_VIV->FldCaption());

		// ACEPTA_TRASLADOS
		$this->ACEPTA_TRASLADOS->EditAttrs["class"] = "form-control";
		$this->ACEPTA_TRASLADOS->EditCustomAttributes = "";
		$this->ACEPTA_TRASLADOS->EditValue = ew_HtmlEncode($this->ACEPTA_TRASLADOS->CurrentValue);
		$this->ACEPTA_TRASLADOS->PlaceHolder = ew_RemoveHtml($this->ACEPTA_TRASLADOS->FldCaption());

		// Activo
		$this->Activo->EditCustomAttributes = "";
		$arwrk = array();
		$arwrk[] = array($this->Activo->FldTagValue(1), $this->Activo->FldTagCaption(1) <> "" ? $this->Activo->FldTagCaption(1) : $this->Activo->FldTagValue(1));
		$arwrk[] = array($this->Activo->FldTagValue(2), $this->Activo->FldTagCaption(2) <> "" ? $this->Activo->FldTagCaption(2) : $this->Activo->FldTagValue(2));
		$this->Activo->EditValue = $arwrk;

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
					if ($this->descripcion->Exportable) $Doc->ExportCaption($this->descripcion);
				} else {
					if ($this->codigo_bodega->Exportable) $Doc->ExportCaption($this->codigo_bodega);
					if ($this->descripcion->Exportable) $Doc->ExportCaption($this->descripcion);
					if ($this->direccion->Exportable) $Doc->ExportCaption($this->direccion);
					if ($this->empleado_encargado->Exportable) $Doc->ExportCaption($this->empleado_encargado);
					if ($this->empleado_mensajes->Exportable) $Doc->ExportCaption($this->empleado_mensajes);
					if ($this->es_abastecedora->Exportable) $Doc->ExportCaption($this->es_abastecedora);
					if ($this->no_traslado->Exportable) $Doc->ExportCaption($this->no_traslado);
					if ($this->negativos->Exportable) $Doc->ExportCaption($this->negativos);
					if ($this->dias_inventario->Exportable) $Doc->ExportCaption($this->dias_inventario);
					if ($this->cuenta_contable->Exportable) $Doc->ExportCaption($this->cuenta_contable);
					if ($this->codigo_centro->Exportable) $Doc->ExportCaption($this->codigo_centro);
					if ($this->cuenta_gastos->Exportable) $Doc->ExportCaption($this->cuenta_gastos);
					if ($this->centro_gastos->Exportable) $Doc->ExportCaption($this->centro_gastos);
					if ($this->no_ingreso->Exportable) $Doc->ExportCaption($this->no_ingreso);
					if ($this->cuenta_costos->Exportable) $Doc->ExportCaption($this->cuenta_costos);
					if ($this->bodega_equivalente->Exportable) $Doc->ExportCaption($this->bodega_equivalente);
					if ($this->factura->Exportable) $Doc->ExportCaption($this->factura);
					if ($this->cuenta_gastos_locales->Exportable) $Doc->ExportCaption($this->cuenta_gastos_locales);
					if ($this->centro_gastos_locales->Exportable) $Doc->ExportCaption($this->centro_gastos_locales);
					if ($this->cuenta_otros_gastos->Exportable) $Doc->ExportCaption($this->cuenta_otros_gastos);
					if ($this->centro_otros_gastos->Exportable) $Doc->ExportCaption($this->centro_otros_gastos);
					if ($this->Pais->Exportable) $Doc->ExportCaption($this->Pais);
					if ($this->FECHA_ULTIMA_ACT->Exportable) $Doc->ExportCaption($this->FECHA_ULTIMA_ACT);
					if ($this->U_VLGX_LT->Exportable) $Doc->ExportCaption($this->U_VLGX_LT);
					if ($this->U_VLGX_VIV->Exportable) $Doc->ExportCaption($this->U_VLGX_VIV);
					if ($this->ACEPTA_TRASLADOS->Exportable) $Doc->ExportCaption($this->ACEPTA_TRASLADOS);
					if ($this->Activo->Exportable) $Doc->ExportCaption($this->Activo);
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
						if ($this->descripcion->Exportable) $Doc->ExportField($this->descripcion);
					} else {
						if ($this->codigo_bodega->Exportable) $Doc->ExportField($this->codigo_bodega);
						if ($this->descripcion->Exportable) $Doc->ExportField($this->descripcion);
						if ($this->direccion->Exportable) $Doc->ExportField($this->direccion);
						if ($this->empleado_encargado->Exportable) $Doc->ExportField($this->empleado_encargado);
						if ($this->empleado_mensajes->Exportable) $Doc->ExportField($this->empleado_mensajes);
						if ($this->es_abastecedora->Exportable) $Doc->ExportField($this->es_abastecedora);
						if ($this->no_traslado->Exportable) $Doc->ExportField($this->no_traslado);
						if ($this->negativos->Exportable) $Doc->ExportField($this->negativos);
						if ($this->dias_inventario->Exportable) $Doc->ExportField($this->dias_inventario);
						if ($this->cuenta_contable->Exportable) $Doc->ExportField($this->cuenta_contable);
						if ($this->codigo_centro->Exportable) $Doc->ExportField($this->codigo_centro);
						if ($this->cuenta_gastos->Exportable) $Doc->ExportField($this->cuenta_gastos);
						if ($this->centro_gastos->Exportable) $Doc->ExportField($this->centro_gastos);
						if ($this->no_ingreso->Exportable) $Doc->ExportField($this->no_ingreso);
						if ($this->cuenta_costos->Exportable) $Doc->ExportField($this->cuenta_costos);
						if ($this->bodega_equivalente->Exportable) $Doc->ExportField($this->bodega_equivalente);
						if ($this->factura->Exportable) $Doc->ExportField($this->factura);
						if ($this->cuenta_gastos_locales->Exportable) $Doc->ExportField($this->cuenta_gastos_locales);
						if ($this->centro_gastos_locales->Exportable) $Doc->ExportField($this->centro_gastos_locales);
						if ($this->cuenta_otros_gastos->Exportable) $Doc->ExportField($this->cuenta_otros_gastos);
						if ($this->centro_otros_gastos->Exportable) $Doc->ExportField($this->centro_otros_gastos);
						if ($this->Pais->Exportable) $Doc->ExportField($this->Pais);
						if ($this->FECHA_ULTIMA_ACT->Exportable) $Doc->ExportField($this->FECHA_ULTIMA_ACT);
						if ($this->U_VLGX_LT->Exportable) $Doc->ExportField($this->U_VLGX_LT);
						if ($this->U_VLGX_VIV->Exportable) $Doc->ExportField($this->U_VLGX_VIV);
						if ($this->ACEPTA_TRASLADOS->Exportable) $Doc->ExportField($this->ACEPTA_TRASLADOS);
						if ($this->Activo->Exportable) $Doc->ExportField($this->Activo);
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
