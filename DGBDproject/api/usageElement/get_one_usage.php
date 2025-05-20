<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');


include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = new Database();
    $db = $db->connect();
    $usage= new AnyTable($db);
    $usage->table = 'usageelement';

    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id)) {
        $usage->identName = 'id';
        $usage->identValue = $data->id;
        $usage->fields = ['id', 'nom'];
        $usage->fetchOne();
        if ($usage->nom != null) {
            $usage_arr = array('id' => $usage ->id,
                'nom' => $usage ->nom,
            );
            echo json_encode($usage_arr);
        } else {
            echo json_encode(array('message' => 'No element found'));
        }
    } else {
        echo json_encode(array('message' => 'No element found'));
    }

}