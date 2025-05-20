<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

// Répondre immédiatement aux requêtes OPTIONS (CORS preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Si c'est une requête DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $db = new Database();
    $db = $db->connect();

    $element = new AnyTable($db);

    // On récupère le corps de la requête JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Vérifie que l'id est bien présent
    if (isset($data['id'])) {
        $element->table = 'elementfrigorifique';
        $element->identName = 'id';
        $element->identValue = $data['id'];
        $element->id = $data['id'];

        if ($element->deleteData()) {
            echo json_encode(['message' => 'element frigorifique deleted']);
        } else {
            echo json_encode(['message' => 'element frigorifique not deleted']);
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'Missing ID']);
    }
}


