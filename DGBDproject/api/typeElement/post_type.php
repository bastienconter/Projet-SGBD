<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $db = new Database();
    $db = $db->connect();
    $type = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));
    $type->table = 'typeelement';
    $type->fields = ['id', 'nom'];
    $type->nom = $data->nom;
    if($type->postData()){
        echo json_encode(array('message' => 'type  created'));
    } else {
        echo json_encode(array('message' => 'type not created'));
    }
} else {
    echo json_encode(array('message' => 'type not created'));
}


