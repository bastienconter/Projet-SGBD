<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../models/alerteTemperature.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $db = (new Database())->connect();
    $alerte = new alerteTemperature($db);

    $res = $alerte->fetchAll();
    $resCount = $res->rowCount();

    if ($resCount > 0) {
        $alerte = [];

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $alerte[] = $row;
        }

        echo json_encode($alerte);
    } else {
        echo json_encode(['message' => 'Aucun élément trouvé.']);
    }

} else {
    echo json_encode(['message' => 'Méthode incorrecte.']);
}
