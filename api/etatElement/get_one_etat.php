<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');


include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = new Database();
    $db = $db->connect();
    $etat = new AnyTable($db);
    $etat->table = 'etatelement';

    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id)) {
        $etat->identName = 'id';
        $etat->identValue = $data->id;
        $etat->fields = ['id', 'nom'];
        $etat->fetchOne();
        if ($etat->nom != null) {
            $etat_arr = array('id' => $etat ->id,
                'nom' => $etat ->nom,
            );
            echo json_encode($etat_arr);
        } else {
            echo json_encode(array('message' => 'No etat found'));
        }
    } else {
        echo json_encode(array('message' => 'No etat found'));
    }

}