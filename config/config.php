<?php
// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

// Login
session_start();

// Autoload of classes
function __autoload($class) {
    include "classes/" . $class . ".class.php";
}

// DB-settings (localhost)

define("DBHOST", "localhost");
define("DBUSER", "dt173g_project");
define("DBPASS", "password");
define("DBDATABASE", "dt173g_project"); 