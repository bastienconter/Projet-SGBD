<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $db = new Database();
    $db = $db->connect();

    $usage= new AnyTable($db,'usageelement');

    $res = $usage->fetchAll();
    $resCount = $res->rowCount();

    if($resCount > 0) {

        $usage= array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
            array_push($usage, array( 'id_usage' => $id,
                'nom_usage' => $nom));
        }

        echo json_encode($usage);

    } else {
        echo json_encode(array('message' => "No records found!"));
    }
} else {
    echo json_encode(array('message' => "Error: incorrect Method!"));
}