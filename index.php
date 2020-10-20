<?php
// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

include("config/config.php");

$login = new Login();

// Login user and direct to admin.php
if(isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if($login->loginUser($username, $password)) {
        header("Location: admin.php");
    } else {
        $message = "<p class='error'>Felaktigt användarnamn / lösenord!</p>";
    }
} 

// Error message
if(isset($_GET["message"])) {
    echo "<p class='err'>" . $_GET["message"] . "</p>";
}

if(isset($message)) {
    echo "<p class='err'>" . $message . "</p>";
}

?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggningssida</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <!-- Index container -->
    <div class="index-container">

        <!-- Login section -->
        <section class="log-in">
            <h2>Logga in</h2>

            <!-- Form -->
            <form method="post" action="index.php">
                <label for="username">Username:</label><br>
                <input type="text" name="username" id="username" required><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" required><br>
                <input type="submit" value="Logga in" class="btn">
            </form>
        </section>
    </div>  
</body>
</html>