<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(472, "mmi_in_bodegas", $Language->MenuPhrase("472", "MenuText"), "in_bodegaslist.php", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(1269, "mmci_Ubicacif3n", $Language->MenuPhrase("1269", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(484, "mmi_in_estanteria", $Language->MenuPhrase("484", "MenuText"), "in_estanterialist.php", 1269, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(536, "mmi_in_seccionestanteria", $Language->MenuPhrase("536", "MenuText"), "in_seccionestanterialist.php", 1269, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(-1, "mmi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mmi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
