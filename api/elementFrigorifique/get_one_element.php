<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');


include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = new Database();
    $db = $db->connect();
    $element = new AnyTable($db);
    $element->table = 'elementfrigorifique';

    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->id)) {
        $element->identName = 'id';
        $element->identValue = $data->id;
        $element->fields = ['id', 'nom', 'numero_serie',  'marque', 'serie', 'date_mise_en_fonction', 'garantie_annees', 'capacite_litres', 'temperature_max', 'temperature_min', 'etat_id', 'type_id', 'usage_id', 'emplacement_id', 'qr_code', 'est_plein', 'remarque'];
        $element->fetchOne();
        if ($element->nom != null) {
            $element_arr = array('id' => $element ->id,
                'nom' => $element ->nom,
                'numero_serie' => $element ->numero_serie,
                'marque' => $element ->marque,
                'serie' => $element ->serie,
                'date_mise_en_fonction' => $element ->date_mise_en_fonction,
                'garantie_annees' => $element ->garantie_annees,
                'capacite_litres' => $element ->capacite_litres,
                'temperature_max' => $element ->temperature_max,
                'temperature_min' => $element ->temperature_min,
                'etat_id' => $element ->etat_id,
                'type_id' => $element ->type_id,
                'usage_id' => $element ->usage_id,
                'emplacement_id' => $element ->emplacement_id,
                'qr_code' => $element ->qr_code,
                'est_plein' => $element ->est_plein, 'remarque' => $element ->remarque
            );
            echo json_encode($element_arr);
        } else {
            echo json_encode(array('message' => 'No element found'));
        }
    } else {
        echo json_encode(array('message' => 'No element found'));
    }

}