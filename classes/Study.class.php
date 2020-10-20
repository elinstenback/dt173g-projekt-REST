<?php
// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

 class Study {

    private $db;
  

    function __construct() {

        // Database connection
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Anslutning misslyckades: " . $this->db->connect_error);
        }
    } 

    // Get inserts in study table
    public function getStudy() {
        $sql =  "SELECT * FROM study";
        $results = $this->db->query($sql);
        $study =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $study;
    } 

    // Create new study in study table
    public function createStudy($university, $courseName, $date) {
        $sql = "INSERT INTO study(university, coursename, date)VALUES('$university', '$courseName', '$date')";
        $this->db->query($sql);
        return true;
    }

    // Delete suty in study table
    public function deleteStudy($index) {
        $sql = "DELETE FROM study WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }

    // Get specifik table from id in study table
    public function getIdStudy($index) {
        $sql =  "SELECT * FROM study WHERE id = '$index'";
        $results = $this->db->query($sql);
        $study =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $study;
    }

    // Update study in study table
    public function updateStudy($university, $courseName, $date, $index) {
        $sql = "UPDATE study SET university = '$university', coursename = '$courseName', date = '$date' WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    } 
} 

  