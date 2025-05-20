<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $db = new Database();
    $db = $db->connect();

    $etat= new AnyTable($db,'etatelement');

    $res = $etat->fetchAll();
    $resCount = $res->rowCount();

    if($resCount > 0) {

        $etat= array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
            array_push($etat, array( 'id_etat' => $id,
                'nom_etat' => $nom));
        }

        echo json_encode($etat);

    } else {
        echo json_encode(array('message' => "No records found!"));
    }
} else {
    echo json_encode(array('message' => "Error: incorrect Method!"));
}