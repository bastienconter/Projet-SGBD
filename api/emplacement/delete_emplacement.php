<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $db = new Database();
    $db = $db->connect();
    $emplacement = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));
    $emplacement->table = 'emplacement';
    $emplacement->identName = 'id';
    $emplacement->identValue = $data->id;
    $emplacement->id = $data->id;
    if ($emplacement->deleteData()) {
        echo json_encode(array('message' => 'emplacement deleted'));
    } else {
        echo json_encode(array('message' => 'emplacement not deleted'));
    }
} else {
    echo json_encode(array('message' => 'emplacement not deleted'));
}