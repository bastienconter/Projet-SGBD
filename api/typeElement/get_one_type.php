<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');


include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = new Database();
    $db = $db->connect();
    $type = new AnyTable($db);
    $type->table = 'typeelement';

    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id)) {
        $type->identName = 'id';
        $type->identValue = $data->id;
        $type->fields = ['id', 'nom'];
        $type->fetchOne();
        if ($type->nom != null) {
            $type_arr = array('id' => $type ->id,
                'nom' => $type ->nom,
            );
            echo json_encode($type_arr);
        } else {
            echo json_encode(array('message' => 'No element found'));
        }
    } else {
        echo json_encode(array('message' => 'No element found'));
    }

}