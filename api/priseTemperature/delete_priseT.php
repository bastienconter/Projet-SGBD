<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $db = new Database();
    $db = $db->connect();
    $prise = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));
    $prise->table = 'prisetemperature';
    $prise->identName = 'id';
    $prise->identValue = $data->id;
    $prise->id = $data->id;
    if ($prise->deleteData()) {
        echo json_encode(array('message' => 'prise deleted'));
    } else {
        echo json_encode(array('message' => 'prise not deleted'));
    }
} else {
    echo json_encode(array('message' => 'prise not deleted'));
}