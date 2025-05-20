<?php

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';
if($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $db = new Database();
    $db = $db->connect();
    $type = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));

    $type->table = 'typeelement';
    $type->fields = ['id', 'nom'];
    if (isset($data->id)) {
        $type->identName = 'id';
        $type->identValue = $data->id;
    } else {
        echo json_encode(array('message' => 'No type found'));
        exit();
    }
    $type->id = $data->id;
    $type->nom = $data->nom;

    if($type->putData()){
        echo json_encode(array('message' => 'type updated'));
    } }
