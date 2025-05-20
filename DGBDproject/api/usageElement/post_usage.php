<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $db = new Database();
    $db = $db->connect();
    $usage = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));
    $usage->table = 'usageelement';
    $usage->fields = ['id', 'nom'];
    $usage->nom = $data->nom;
    if($usage->postData()){
        echo json_encode(array('message' => 'usage  created'));
    } else {
        echo json_encode(array('message' => 'usage not created'));
    }
} else {
    echo json_encode(array('message' => 'usage not created'));
}
