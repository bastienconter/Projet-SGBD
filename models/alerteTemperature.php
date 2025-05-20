<?php
include_once '../../lib/AnyTable.php';

class alerteTemperature extends AnyTable
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
            at.id AS alerte_id,
            at.temperature AS temperature_alerte,
            at.date_heure AS date_alerte,
            at.message AS message_alerte,
            ef.nom AS nom_element,
            ef.numero_serie,
            ef.marque,
            ef.serie,
            ef.capacite_litres,
            ef.temperature_min,
            ef.temperature_max,
            ef.est_plein,
            ef.remarque,
            em.nom AS emplacement,
            te.nom AS type_element,
            ue.nom AS usage_element,
            ee.nom AS etat_element
        FROM alertetemperature at
        JOIN elementfrigorifique ef ON at.element_id = ef.id
        LEFT JOIN emplacement em ON ef.emplacement_id = em.id
        LEFT JOIN typeelement te ON ef.type_id = te.id
        LEFT JOIN usageelement ue ON ef.usage_id = ue.id
        LEFT JOIN etatelement ee ON ef.etat_id = ee.id
        ORDER BY at.date_heure DESC
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}