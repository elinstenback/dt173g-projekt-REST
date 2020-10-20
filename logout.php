<?php
// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

// End session and logout user
session_start();
session_unset();
session_destroy();

header("Location: admin.php");
exit();
?>