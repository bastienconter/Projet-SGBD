<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../models/elementFrigorifique.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $db = (new Database())->connect();
    $element = new elementFrigorifique($db);

    $res = $element->fetchAll();
    $resCount = $res->rowCount();

    if ($resCount > 0) {
        $elements = [];

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $elements[] = $row;
        }

        echo json_encode($elements);
    } else {
        echo json_encode(['message' => 'Aucun élément trouvé.']);
    }

} else {
    echo json_encode(['message' => 'Méthode incorrecte.']);
}
