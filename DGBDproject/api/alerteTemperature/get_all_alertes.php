<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $db = new Database();
    $db = $db->connect();

    $alerte= new AnyTable($db,'alertetemperature');

    $res = $alerte->fetchAll();
    $resCount = $res->rowCount();

    if($resCount > 0) {

        $alerte = array();

        while($row = $res->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
            array_push($alerte, array( 'id' => $id,
                'temperature' => $temperature,
                'date_heure' => $date_heure,
                'message' => $message,
                'element_id' => $element_id));
        }

        echo json_encode($alerte);

    } else {
        echo json_encode(array('message' => "No records found!"));
    }
} else {
    echo json_encode(array('message' => "Error: incorrect Method!"));
}


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

/*
include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = new Database();
    $db = $db->connect();
    $alerte = new AnyTable($db);
    $alerte->table = 'alertetemperature';
    $res = $alerte->fetchAll();
    $alerte_arr = array();

    foreach ($res as $row) {
        $alerte_item = array(
            'id' => $row['id'],
            'temperature' => $row['temperature'],
            'date_heure' => $row['date_heure'],
            'message' => $row['message'],
            'element_id' => $row['element_id']

        );
        array_push($alerte_arr, $alerte_item);
    }
    echo json_encode($alerte_arr);

} else {
    echo json_encode(array('message' => 'No temperature found'));


}
*/
