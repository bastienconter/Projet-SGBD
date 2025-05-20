<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $db = new Database();
    $db = $db->connect();
    $etat = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));
    $etat->table = 'etatelement';
    $etat->identName = 'id';
    $etat->identValue = $data->id;
    $etat->id = $data->id;
    if ($etat->deleteData()) {
        echo json_encode(array('message' => 'etatelement deleted'));
    } else {
        echo json_encode(array('message' => 'etatelement not deleted'));
    }
} else {
    echo json_encode(array('message' => 'etatelement not deleted'));
}