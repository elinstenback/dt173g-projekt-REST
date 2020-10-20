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
$study = new Study();
$data = json_decode(file_get_contents("php://input"), true);

// Checks if there's an id and get's it
if (isset($_GET['id'])) {
    $index = $_GET['id'];
}

// Switch
switch ($method) {
    case "GET":
     // Get study table
    if (isset($index)) {
        $response = $study->getIdStudy($index);
    } else {
        $response = $study->getStudy();
    }
    if (sizeof($response) > 0) {
        http_response_code(200); //Ok = fetched
    } else {
         http_response_code(404); // Not found
         $response = array("message" => "No study was found.");
    }
break;
    case "PUT":
        // Update study table
        $university = $data['university'];
        $courseName = $data['coursename'];
        $date = $data['date'];

        if($study->updateStudy($university, $courseName, $date, $index)) {
            http_response_code(200); // Ok = updated
            $response = array("message" => "Study updated.");
        } else {
            http_response_code(500); // Server error
            $response = array("message" => "Error updating study.");
        }
        break;
    case "POST":
        // Create new study and add to study table
        $university = $data['university'];
        $courseName = $data['coursename'];
        $date = $data['date'];
        if($study->createStudy($university, $courseName, $date)) {
            http_response_code(201); // Ok = created
            $response = array("message" => "Study created.");
        } else {
            http_response_code(503); // Server error
            $response = array("message" => "Study not created.");
        }
        break;
    case "DELETE":
        // Delete from study table
        if (!isset($index)) {
            http_response_code(501);
            $response = array("message" => "No id found.");
        } else {
            // If id
            if ($study->deleteStudy($index)) {
                http_response_code(200);
                $response = array("message" => "Study deleted");
            } else {
                http_response_code(500);
                $response = array("message" => "Study not deleted");
            }
        }
    break;
}

echo json_encode($response);