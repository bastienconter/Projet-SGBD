<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $db = new Database();
    $db = $db->connect();

    $prise= new AnyTable($db,'prisetemperature');

    $res = $prise->fetchAll();
    $resCount = $res->rowCount();

    if($resCount > 0) {

        $prise= array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
            array_push($prise, array( 'id' => $id,
                'date_heure' => $date_heure,
                'temperature' => $temperature,
                'element_id' => $element_id,));
        }

        echo json_encode($prise);

    } else {
        echo json_encode(array('message' => "No records found!"));
    }
} else {
    echo json_encode(array('message' => "Error: incorrect Method!"));
}