<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');


include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = new Database();
    $db = $db->connect();
    $emplacement = new AnyTable($db);
    $emplacement->table = 'emplacement';

    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id)) {
        $emplacement->identName = 'id';
        $emplacement->identValue = $data->id;
        $emplacement->fields = ['id', 'nom', 'parent_id'];
        $emplacement->fetchOne();
        if ($emplacement->nom != null) {
            $emplacement_arr = array('id' => $emplacement ->id,
                'nom' => $emplacement ->nom,
                'parent_id' => $emplacement ->parent_id
            );
            echo json_encode($emplacement_arr);
        } else {
            echo json_encode(array('message' => 'No emplacement found'));
        }
    } else {
        echo json_encode(array('message' => 'No emplacement found'));
    }

}