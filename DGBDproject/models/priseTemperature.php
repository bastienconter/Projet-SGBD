<?php
include_once '../../lib/AnyTable.php';

class priseTemperature extends AnyTable
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
        pt.id AS id_prise,
        pt.date_heure,
        pt.temperature,
        ef.nom AS nom_element
    FROM prisetemperature pt
    JOIN elementfrigorifique ef ON pt.element_id = ef.id
    WHERE ef.id = ?
    ORDER BY pt.date_heure DESC
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->identValue, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $results = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Ajouter chaque ligne de résultats dans un tableau
                $results[] = $row;
            }
            return $results; // Retourner le tableau de résultats
        }
        return false; // Retourner false s'il n'y a aucun résultat
    }


    /*  public function fetchAll()
      {
          $query = "
          SELECT
              pt.id AS id_prise,
              pt.date_heure,
              pt.temperature,
              ef.nom AS nom_element
          FROM prisetemperature pt
          JOIN elementfrigorifique ef ON pt.element_id = ef.id
          ORDER BY pt.date_heure DESC";
          $stmt = $this->conn->prepare($query);
          $stmt->execute();

          return $stmt;
      }*/
}