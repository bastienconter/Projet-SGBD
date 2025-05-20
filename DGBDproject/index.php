<?php

include_once ('lib/routing.php');
include_once ('config/Database.php');

$MR = new Routing(__DIR__.'/api/');
$MR->pathTo404 = __DIR__.'/errors/';

/***************************************************
 *   Définition des routes pour DGBDproject        *
 ***************************************************/

// ELEMENT FRIGORIFIQUE
$MR->get('/DGBDproject/index.php/elements', 'elementFrigorifique/get_all_elements.php');
$MR->get('/DGBDproject/index.php/element', 'elementFrigorifique/get_one_element.php');
$MR->post('/DGBDproject/index.php/add-element', 'elementFrigorifique/post_element.php');
$MR->put('/DGBDproject/index.php/update-element', 'elementFrigorifique/put_element.php');
$MR->delete('/DGBDproject/index.php/delete-element', 'elementFrigorifique/delete_element.php');

// PRISE TEMPERATURE
$MR->get('/DGBDproject/index.php/prises', 'priseTemperature/get_all_prises.php');
$MR->get('/DGBDproject/index.php/prise', 'priseTemperature/get_one_prise.php');
$MR->post('/DGBDproject/index.php/add-prise', 'priseTemperature/post_prise.php');
$MR->put('/DGBDproject/index.php/update-prise', 'priseTemperature/put_prise.php');
$MR->delete('/DGBDproject/index.php/delete-prise', 'priseTemperature/delete_prise.php');

// ALERTES TEMPERATURE
$MR->get('/DGBDproject/index.php/alertes', 'alerteTemperature/get_all_alertes.php');
$MR->get('/DGBDproject/index.php/alerte', 'alerteTemperature/get_one_alerte.php');
$MR->post('/DGBDproject/index.php/add-alerte', 'alerteTemperature/post_alerte.php');
$MR->put('/DGBDproject/index.php/update-alerte', 'alerteTemperature/put_alerte.php');
$MR->delete('/DGBDproject/index.php/delete-alerte', 'alerteTemperature/delete_alerte.php');

// ETAT ELEMENT
$MR->get('/DGBDproject/index.php/etats', 'etatElement/get_all_etats.php');

// TYPE ELEMENT
$MR->get('/DGBDproject/index.php/types', 'typeElement/get_all_types.php');

// EMPLACEMENT
$MR->get('/DGBDproject/index.php/emplacements', 'emplacement/get_all_emplacements.php');

// USAGE ELEMENT
$MR->get('/DGBDproject/index.php/usages', 'usageElement/get_all_usages.php');

// Fallback 404
$MR->closeRouting();
