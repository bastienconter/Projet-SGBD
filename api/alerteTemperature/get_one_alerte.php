<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');


include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = new Database();
    $db = $db->connect();
    $alerte = new AnyTable($db);
    $alerte->table = 'alertetemperature';

    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id)) {
        $alerte->identName = 'id';
        $alerte->identValue = $data->id;
        $alerte->fields = ['id', 'temperature', 'date_heure',  'message', 'element_id'];
        $alerte->fetchOne();
        if ($alerte->temperature != null) {
            $alerte_arr = array(
                'id' => $alerte->id,
                'temperature' => $alerte->temperature,
                'date_heure' => $alerte->date_heure,
                'message' => $alerte->message,
                'element_id' => $alerte->element_id
            );
            echo json_encode($alerte_arr);
        } else {
            echo json_encode(array('message' => 'No temperature found'));
        }
    } else {
        echo json_encode(array('message' => 'No temperature found'));
    }


}
