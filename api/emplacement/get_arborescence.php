<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../models/emplacement.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = (new Database())->connect();
    $arbo = new emplacement($db);
    $tree = $arbo->fetchAll();
    echo json_encode($tree);
} else {
    echo json_encode(['message' => 'Méthode incorrecte.']);
}
