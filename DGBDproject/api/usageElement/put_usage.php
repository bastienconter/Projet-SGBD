<?php

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';
if($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $db = new Database();
    $db = $db->connect();
    $usage = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));

    $usage->table = 'usageelement';
    $usage->fields = ['id', 'nom'];
    if (isset($data->id)) {
        $usage->identName = 'id';
        $usage->identValue = $data->id;
    } else {
        echo json_encode(array('message' => 'No type found'));
        exit();
    }
    $usage->id = $data->id;
    $usage->nom = $data->nom;

    if($usage->putData()){
        echo json_encode(array('message' => 'type updated'));
    } }
