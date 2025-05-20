<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $db = new Database();
    $db = $db->connect();
    $prise = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));
    $prise->table = 'prisetemperature';
    $prise->fields = ['id', 'date_heure', 'temperature', 'element_id'];

    $prise->date_heure = $data->date_heure;
    $prise->temperature = $data->temperature;
    $prise->element_id = $data->element_id;
     if($prise->postData()){
        echo json_encode(array('message' => 'prise temperature  created'));
    } else {
        echo json_encode(array('message' => 'prise temperature not created'));
    }
}

