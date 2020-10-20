<?php

// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

// Login user to get access to admin page
class Login {
    public function loginUser($username, $password) {
            if($username == "" && $password == "") {
                $_SESSION["username"] = $username;
                return true;
            } else {
                return false;
            }
        }
    }
?>