<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $db = new Database();
    $db = $db->connect();
    $usage = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));
    $usage->table = 'usageelement';
    $usage->identName = 'id';
    $usage->identValue = $data->id;
    $usage->id = $data->id;
    if ($usage->deleteData()) {
        echo json_encode(array('message' => '$usage deleted'));
    } else {
        echo json_encode(array('message' => '$usage not deleted'));
    }
} else {
    echo json_encode(array('message' => '$usage not deleted'));
}