<?php
// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

include("config/config.php");

// Control if user is logged in, if not directed to login.php with error message
if(!isset($_SESSION["username"])) {
    header("Location: index.php?message=Du måste vara inloggad!");
}

?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admininistrationssida</title>
    <!-- Stylesheeet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Container -->
<div class="container">
    <header>
        <h2>Admin</h2>
        <a class="logout-btn" href="logout.php">Logga ut</a>
    </header>
    
    <!-- Portfolio section -->
    <section id="portfolio">
    <h2>Portfolio</h2>
        <p>Titel</p>
        <p>Url</p>
        <p>Beskrivning</p>
        <p>Radera</p>
        <p>Uppdatera</p>

        <!-- Print from db -->
        <div id="printPortfolio"></div>

        <!-- Portfolio form -->
        <form id="portfolioForm">
            <input type="text" name="id" id="portfolioId"><br>
            <label for="title">Titel:</label><br>
            <input type="text" name="title" id="title"><br>
            <label for="url">Url:</label><br>
            <input type="text" name="url" id="url"><br>
            <label for="description">Beskrivning:</label><br>
            <input type="text" name="description" id="description"><br>
            <input type="submit" value="Lägg till portfolio" id="addPortfolio">
        </form>
    </section>

    <!-- Study section -->
    <section id="study">
    <h2>Studier</h2>
        <p>Universitet</p>
        <p>Kursnamn</p>
        <p>Datum</p>
        <p>Radera</p>
        <p>Uppdatera</p>

        <!-- Print from db -->
        <div id="printStudy"></div>

        <!-- Study form -->
        <form id="studyForm">
            <input type="text" name="id" id="studyId"><br>
            <label for="university">Universitet:</label><br>
            <input type="text" name="university" id="university"><br>
            <label for="courseName">Kursnamn:</label><br>
            <input type="text" name="courseName" id="courseName"><br>
            <label for="date">Datum:</label><br>
            <input type="text" name="date" id="date"><br>
            <input type="submit" value="Lägg till studie" id="addStudy">
        </form>
    </section>

    <!-- Work section -->
    <section id="work">
    <h2>Arbete</h2>
        <p>Namn</p>
        <p>Titel</p>
        <p>Datum</p>
        <p>Radera</p>
        <p>Uppdatera</p>

        <!-- Print from db -->
        <div id="printWork"></div>

        <!-- Work form -->
        <form id="workForm">
            <input type="text" name="id" id="workId"><br>
            <label for="workName">Namn:</label><br>
            <input type="text" name="workName" id="workName"><br>
            <label for="workTitle">Titel:</label><br>
            <input type="text" name="workTitle" id="workTitle"><br>
            <label for="workDate">Datum:</label><br>
            <input type="text" name="workDate" id="workDate"><br>
            <input type="submit" value="Lägg till arbete" id="addWork">
        </form>
    </section>
</div>
<!-- JavaScript -->
<script src="js/portfolio.js"></script>
<script src="js/study.js"></script>
<script src="js/work.js"></script>
</body>
</html>