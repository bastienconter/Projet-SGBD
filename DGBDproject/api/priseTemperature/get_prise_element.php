<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../models/priseTemperature.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = new Database();
    $db = $db->connect();

    $prise = new priseTemperature($db); // Tu peux adapter le nom de la classe si besoin

    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->element_id)) {
        $prise->identName = 'element_id';           // Ce champ ne sera pas utilisé dans le SQL, mais dans bindParam()
        $prise->identValue = $data->element_id;     // L'ID de l'élément frigorifique à rechercher
        $prise->fields = ['id_prise', 'date_heure', 'temperature', 'nom_element'];

        // Récupérer les résultats
        $res = $prise->fetchAll();

        if ($res) {
            echo json_encode($res); // Retourner les résultats en JSON
        } else {
            echo json_encode(['message' => 'Aucun élément trouvé.']);
        }
    } else {
        echo json_encode(['message' => 'Missing element_id']);
    }
}

