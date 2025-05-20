<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $db = new Database();
    $db = $db->connect();

    $element= new AnyTable($db,'elementfrigorifique');

    $res = $element->fetchAll();
    $resCount = $res->rowCount();

    if($resCount > 0) {

        $alerte = array();

        while($row = $res->fetch(PDO::FETCH_ASSOC)) {

            extract($row);
            array_push($alerte, array( 'id' => $id,
                'nom' => $nom,
                'numero_serie' => $numero_serie,
                'marque' => $marque,
                'serie' => $serie,
                'date_mise_en_fonction' => $date_mise_en_fonction,
                'garantie_annees' => $garantie_annees,
                'capacite_litres' => $capacite_litres,
                'temperature_max' => $temperature_max,
                'temperature_min' => $temperature_min,
                'etat_id' => $etat_id,
                'type_id' => $type_id,
                'usage_id' => $usage_id,
                'emplacement_id' => $emplacement_id,
                'qr_code' => $qr_code,
                'est_plein' => $est_plein, 'remarque' => $remarque));
        }

        echo json_encode($alerte);

    } else {
        echo json_encode(array('message' => "No records found!"));
    }
} else {
    echo json_encode(array('message' => "Error: incorrect Method!"));
}

/*


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');


include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db=new Database();
    $db = $db->connect();
    $element = new AnyTable($db);
    $element->table = 'elementfrigorifique';
    $res =$element->fetchOne();
    $element_arr = array();

    foreach($res as $row){
        $element_item = array(
            'id' => $row['id'],
            'nom' => $row['nom'],
            'numero_serie' => $row['numero_serie'],
            'marque' => $row['marque'],
            'serie' => $row['serie'],
            'date_mise_en_fonction' => $row['date_mise_en_fonction'],
            'garantie_annees' => $row['garantie_annees'],
            'capacite_litres' => $row['capacite_litres'],
            'temperature_max' => $row['temperature_max'],
            'temperature_min' => $row['temperature_min'],
            'etat_id' => $row['etat_id'],
            'type_id' => $row['type_id'],
            'usage_id' => $row['usage_id'],
            'emplacement_id' => $row['emplacement_id'],
            'qr_code' => $row['qr_code'],
            'est_plein' => $row['est_plein'],
            'remarque' => $row['remarque']

        );
        array_push($element_arr, $element_item);
    }
    echo json_encode($element_arr);

} else {
    echo json_encode(array('message' => 'No temperature found'));}

*/