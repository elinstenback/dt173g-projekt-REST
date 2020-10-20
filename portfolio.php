<?php
// Projekt — DT0173G, Webbutveckling, Mittuniversitetet. Av Elin Stenbäck 2020 

include("config/config.php");

// Headers to make service available from all domains
header("Content-Type: application/json; charset=UTF-8;");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE"); 


// Variables
$method = $_SERVER["REQUEST_METHOD"];
$portfolio = new Portfolio();
$data = json_decode(file_get_contents("php://input"), true);

// Checks if there's an id and get's it
if (isset($_GET['id'])) {
    $index = $_GET['id'];
}

// Switch
switch ($method) {
    case "GET":
    // Get portfolio table
    if (isset($index)) {
        $response = $portfolio->getIdPortfolio($index);
    } else {
        $response = $portfolio->getPortfolio();
    }
    if (sizeof($response) > 0) {
        http_response_code(200); //Ok = fetched
    } else {
        http_response_code(404); // Not found
        $response = array("message" => "No portfolio was found.");
    }
break;
    case "PUT":
        // Update portfolio table
        $title = $data['title'];
        $url = $data['url'];
        $description = $data['description'];
        
        if($portfolio->updatePortfolio($title, $url, $description, $index)) {
            http_response_code(200); // Ok = updated
            $response = array("message" => "Portfolio updated.");
        } else {
            http_response_code(500); // Server error
            $response = array("message" => "Error updating portfolio.");
        }
        break;
    case "POST":
        // Create new project and add to portfolio table
        $title = $data['title'];
        $url = $data['url'];
        $description = $data['description'];
        if($portfolio->createPortfolio($title, $url, $description)) {
            http_response_code(201); // Ok = created
            $response = array("message" => "Portfolio created.");
        } else {
            http_response_code(503); // Server error
            $response = array("message" => "Portfolio not created.");
        }
        break;
    case "DELETE":
        // Create project from portfolio table
        if (!isset($index)) {
            http_response_code(501);
            $response = array("message" => "No id found.");
        } else {
            // If id
            if ($portfolio->deletePortfolio($index)) {
                http_response_code(200);
                $response = array("message" => "Portfolio deleted");
            } else {
                http_response_code(500);
                $response = array("message" => "Portfolio not deleted");
            }
        }
    break;
}

echo json_encode($response);
