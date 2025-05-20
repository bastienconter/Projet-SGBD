<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
 header("Access-Control-Allow-Methods:  POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../lib/AnyTable.php';
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $db = new Database();
    $db = $db->connect();
    $element = new AnyTable($db);
    $data = json_decode(file_get_contents("php://input"));
    $element->table = 'elementfrigorifique';
    $element->fields = ['id', 'nom', 'numero_serie', 'marque', 'date_mise_en_fonction', 'garantie_annees', 'capacite_litres', 'temperature_max', 'temperature_min','etat_id', 'type_id', 'usage_id', 'emplacement_id', 'qr_code', 'est_plein', 'remarque'];
    $element->nom = $data->nom;
    $element->numero_serie = $data->numero_serie;
    $element->marque = $data->marque;
    $element->date_mise_en_fonction = $data->date_mise_en_fonction;
    $element->garantie_annees = $data->garantie_annees;
    $element->capacite_litres = $data->capacite_litres;
    $element->temperature_max = $data->temperature_max;
    $element->temperature_min = $data->temperature_min;
    $element->etat_id = $data->etat_id;
    $element->type_id = $data->type_id;
    $element->usage_id = $data->usage_id;
    $element->emplacement_id = $data->emplacement_id;
    $element->qr_code = $data->qr_code;
    $element->est_plein = $data->est_plein;
    $element->remarque = $data->remarque;



    if($element->postData()){
        echo json_encode(array('message' => 'element  created'));
    } else {
        echo json_encode(array('message' => 'element not created'));
    }
} else {
    echo json_encode(array('message' => 'element not created'));
}


