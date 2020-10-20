<?php
// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

include("config/config.php");

// Headers to make service available from all domains
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Acess-Control-Allow-Methods, Authorization, x-Requested-With");


// Variables
$method = $_SERVER["REQUEST_METHOD"];
$work = new Work();
$data = json_decode(file_get_contents("php://input"), true);


// Checks if there's an id and get's it
if (isset($_GET['id'])) {
    $index = $_GET['id'];
}


// Switch
switch ($method) {
    case "GET":
        // Get work table
        if (isset($index)) {
            $response = $work->getIdWork($index);
        } else {
            $response = $work->getWork();
        }
        if (sizeof($response) > 0) {
            http_response_code(200); //Ok = fetched
        } else {
         http_response_code(404); // Not found
            $response = array("message" => "No work was found.");
        }
        break;
    case "PUT":
        // Update work table
        $name = $data['name'];
        $title = $data['title'];
        $date = $data['date'];
        
        if($work->updateWork($name, $title, $date, $index)) {
            http_response_code(200); // Ok = updated
            $response = array("message" => "Work updated.");
        } else {
            http_response_code(500); // Server error
            $response = array("message" => "Error updating work.");
        }
        break;
    case "POST":
        // Create new work and add to work table
        $name= $data['name'];
        $title = $data['title'];
        $date = $data['date'];
        if($work->createWork($name, $title, $date)) {
            http_response_code(201); // Ok = created
            $response = array("message" => "Work created.");
        } else {
            http_response_code(503); // Server error
            $response = array("message" => "Work not created.");
        }
        break;
    case "DELETE":
        // Delete from work table
        if (!isset($index)) {
            http_response_code(501);
            $response = array("message" => "No id found.");
        } else {
            // if
            if ($work->deleteWork($index)) {
                http_response_code(200);
                $response = array("message" => "Work deleted");
            } else {
                http_response_code(500);
                $response = array("message" => "Work not deleted");
            }
        }
    break;
}

echo json_encode($response);