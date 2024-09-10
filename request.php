<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
}

require_once __DIR__ . "/spring.php";

if ($_SERVER["REQUEST_URI"] === "/new-package") {
    $json = json_decode(file_get_contents("php://input"), true);
    
    $order = [];
    $params = [];
    
    foreach ($json as $key => $value) {
        if (preg_match('/^(recipient|sender)/', $key)) {
            $order[$key] = $value;
        } else {
            $params[$key] = $value;
        }
    }
    
    $spring = new SpringCourier();
    
    $response = $spring->newPackage($order, $params);
    
    header("HTTP/1.1 {$response['code']}");
    echo json_encode($response);
}

if ($_SERVER["REQUEST_URI"] === "/get-label") {

}