<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $db = new Database();
    $db = $db->connect();
    $emplacement = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));
    $emplacement->table = 'emplacement';
    $emplacement->fields = ['id', 'nom', 'parent_id'];

    $emplacement->nom = $data->nom;
    $emplacement->parent_id = $data->parent_id;



    if($emplacement->postData()){
        echo json_encode(array('message' => 'emplacement  created'));
    } else {
        echo json_encode(array('message' => 'emplacement not created'));
    }
} else {
    echo json_encode(array('message' => 'emplacement not created'));
}


