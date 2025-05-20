<?php

include_once '../../lib/AnyTable.php';

class elementFrigorifique extends \AnyTable
{
    private $conn;
    public $table= '';
    public $identName = '';
    public $identValue = '';
    public $fields = [];
    public function __construct($db)
    {
        parent::__construct($db);
        if (!$db) {
            die(json_encode(["error" => "La connexion à la base de données est invalide."]));
        }
        $this->conn = $db;
    }
    public function fetchAll()
    {
        $query = "
       SELECT
    ef.id AS element_id,
    ef.nom AS nom_element,
    ef.numero_serie,
    ef.marque,
    ef.serie,
    ef.date_mise_en_fonction,
    ef.garantie_annees,
    ef.capacite_litres,
    ef.temperature_min,
    ef.temperature_max,
    ef.est_plein,
    ef.remarque,
    ef.qr_code,
    ef.emplacement_id,
    em.nom AS emplacement,
    ef.type_id,
    te.nom AS type_element,
    ef.usage_id,
    ue.nom AS usage_element,
    ef.etat_id,
    ee.nom AS etat_element
FROM elementfrigorifique ef
LEFT JOIN emplacement em ON ef.emplacement_id = em.id
LEFT JOIN typeelement te ON ef.type_id = te.id
LEFT JOIN usageelement ue ON ef.usage_id = ue.id
LEFT JOIN etatelement ee ON ef.etat_id = ee.id;
";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


}