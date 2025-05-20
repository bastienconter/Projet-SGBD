<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $db = new Database();
    $db = $db->connect();

    $emplacement= new AnyTable($db,'emplacement');

    $res = $emplacement->fetchAll();
    $resCount = $res->rowCount();

    if($resCount > 0) {

        $emplacement= array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
            array_push($emplacement, array( 'id_emplacement' => $id,
                'nom_emplacement' => $nom,
                'parent_id' => $parent_id,
               ));
        }

        echo json_encode($emplacement);

    } else {
        echo json_encode(array('message' => "No records found!"));
    }
} else {
    echo json_encode(array('message' => "Error: incorrect Method!"));
}