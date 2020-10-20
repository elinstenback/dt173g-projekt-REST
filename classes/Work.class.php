<?php
// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

 class Work {

    private $db;
  

    function __construct() {

        // Database connection
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Anslutning misslyckades: " . $this->db->connect_error);
        }
    } 

    // Get inserts in work table
    public function getWork() {
        $sql =  "SELECT * FROM work";
        $results = $this->db->query($sql);
        $work =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $work;
    } 

    // Create new work in work table
    public function createWork($name, $title, $date) {
        $sql = "INSERT INTO work(name, title, date)VALUES('$name', '$title', '$date')";
        $this->db->query($sql);
        return true;
    }

    // Delete work in work table
    public function deleteWork($index) {
        $sql = "DELETE FROM work WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }

    // Get specifik table from id in work table
    public function getIdWork($index) {
        $sql =  "SELECT * FROM work WHERE id = '$index'";
        $results = $this->db->query($sql);
        $work =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $work;
    }

    // Update work in work table
    public function updateWork($name, $title, $date, $index) {
        $sql = "UPDATE work SET name = '$name', title = '$title', date = '$date' WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    } 
} 

  