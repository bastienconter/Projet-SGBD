<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $db = new Database();
    $db = $db->connect();

    $type= new AnyTable($db,'typeelement');

    $res = $type->fetchAll();
    $resCount = $res->rowCount();

    if($resCount > 0) {

        $type= array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
            array_push($type, array( 'id_type' => $id,
                'nom_type' => $nom));
        }

        echo json_encode($type);

    } else {
        echo json_encode(array('message' => "No records found!"));
    }
} else {
    echo json_encode(array('message' => "Error: incorrect Method!"));
}