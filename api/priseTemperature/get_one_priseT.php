<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');


include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = new Database();
    $db = $db->connect();
    $prise = new AnyTable($db);
    $prise->table = 'prisetemperature';

    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id)) {
        $prise->identName = 'id';
        $prise->identValue = $data->id;
        $prise->fields = ['id', 'date_heure', 'temperature', 'element_id'];
        $prise->fetchOne();
        if ($prise->temperature != null) {
            $prise_arr = array('id' => $prise ->id,
                'date_heure' => $prise ->date_heure,
                'temperature' => $prise ->temperature,
                'element_id' => $prise ->element_id
            );
            echo json_encode($prise_arr);
        } else {
            echo json_encode(array('message' => 'No temperature found'));
        }
    } else {
        echo json_encode(array('message' => 'No temperature found'));
    }

}