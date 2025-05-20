<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $db = new Database();
    $db = $db->connect();
    $type = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));
    $type->table = 'typeelement';
    $type->identName = 'id';
    $type->identValue = $data->id;
    $type->id = $data->id;
    if ($type->deleteData()) {
        echo json_encode(array('message' => 'type deleted'));
    } else {
        echo json_encode(array('message' => 'type not deleted'));
    }
} else {
    echo json_encode(array('message' => 'type not deleted'));
}