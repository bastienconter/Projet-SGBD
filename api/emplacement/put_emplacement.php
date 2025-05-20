<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';
if($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $db = new Database();
    $db = $db->connect();
    $emplacement = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));

    $emplacement->table = 'emplacement';
    $emplacement->fields = ['id', 'nom', 'parent_id'];
    if (isset($data->id)) {
        $emplacement->identName = 'id';
        $emplacement->identValue = $data->id;
    } else {
        echo json_encode(array('message' => 'No $emplacement found'));
        exit();
    }
    $emplacement->id = $data->id;
    $emplacement->nom = $data->nom;
    $emplacement->parent_id = $data->parent_id;

    if($emplacement->putData()){
        echo json_encode(array('message' => '$emplacement updated'));
    } }
