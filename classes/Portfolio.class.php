<?php
// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

 class Portfolio {

    private $db;
  

    function __construct() {

        // Database connection
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Anslutning misslyckades: " . $this->db->connect_error);
        }
    } 

    // Get inserts in portfolio table
    public function getPortfolio() {
        $sql =  "SELECT * FROM portfolio";
        $results = $this->db->query($sql);
        $portfolio =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $portfolio;
    } 

    // Create new portfolio in portfolio table
    public function createPortfolio($title, $url, $description) {
        $sql = "INSERT INTO portfolio(title, url, description)VALUES('$title', '$url', '$description')";
        $this->db->query($sql);
        return true;
    }

    // Delete project in portfolio table
    public function deletePortfolio($index) {
        $sql = "DELETE FROM portfolio WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }

    // Get specifik table from id in portfolio table
    public function getIdPortfolio($index) {
        $sql =  "SELECT * FROM portfolio WHERE id = '$index'";
        $results = $this->db->query($sql);
        $portfolio =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $portfolio;
    }

    // Update project in portfolio table
    public function updatePortfolio($title, $url, $description, $index) {
        $sql = "UPDATE portfolio SET title = '$title', url = '$url', description = '$description' WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    } 
} 

  