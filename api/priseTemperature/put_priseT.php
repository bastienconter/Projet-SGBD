<?php

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';
if($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $db = new Database();
    $db = $db->connect();
    $prise = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));

    $prise->table = 'prisetemperature';
    $prise->fields = ['id', 'date_heure', 'temperature', 'element_id'];
    if (isset($data->id)) {
        $prise->identName = 'id';
        $prise->identValue = $data->id;
    } else {
        echo json_encode(array('message' => 'No prise temperature found'));
        exit();
    }
    $prise->id = $data->id;
    $prise->date_heure = $data->date_heure;
    $prise->temperature = $data->temperature;
    $prise->element_id = $data->element_id;


    if($prise->putData()){
        echo json_encode(array('message' => 'prise temperature updated'));
    } }
