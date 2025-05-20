<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $db = new Database();
    $db = $db->connect();
    $etat = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));
    $etat->table = 'etatelement';
    $etat->fields = ['id', 'nom'];
    $etat->nom = $data->nom;
    if($etat->postData()){
        echo json_encode(array('message' => 'etat  created'));
    } else {
        echo json_encode(array('message' => 'etat not created'));
    }
} else {
    echo json_encode(array('message' => 'etat not created'));
}


