<?php

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';
if($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $db = new Database();
    $db = $db->connect();
    $etat = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));

    $etat->table = 'etatelement';
    $etat->fields = ['id', 'nom'];
    if (isset($data->id)) {
        $etat->identName = 'id';
        $etat->identValue = $data->id;
    } else {
        echo json_encode(array('message' => 'No etat found'));
        exit();
    }
    $etat->id = $data->id;
    $etat->nom = $data->nom;

    if($etat->putData()){
        echo json_encode(array('message' => 'etat updated'));
    } }
