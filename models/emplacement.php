<?php
include_once '../../lib/AnyTable.php';

class emplacement extends AnyTable
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
        // 🔹 Étape 1 : récupération de tous les emplacements avec leurs relations parent/enfant
        // Récupérer tous les emplacements
        $stmtEmp = $this->conn->prepare("SELECT id, nom, parent_id FROM emplacement");
        $stmtEmp->execute();
        $emplacements = $stmtEmp->fetchAll(PDO::FETCH_ASSOC);
        // 🔹 Étape 2 : préparation d'un tableau indexé par ID pour créer la structure hiérarchique
        // Indexer les emplacements par ID
        $indexed = [];
        foreach ($emplacements as $emp) {
            // On ajoute deux clés vides pour contenir les enfants et les équipements plus tard
            $emp['children'] = [];
            $emp['elements'] = [];
            // On indexe chaque emplacement par son ID
            $indexed[$emp['id']] = $emp;
        }
        // 🔹 Étape 3 : récupération de tous les équipements et de leur ID d'emplacement
        // Récupérer tous les équipements
        $stmtEq = $this->conn->prepare("SELECT id, nom, emplacement_id FROM elementfrigorifique");
        $stmtEq->execute();
        $equipements = $stmtEq->fetchAll(PDO::FETCH_ASSOC);
        // 🔹 Étape 4 : on associe chaque équipement à son emplacement
        // Associer les équipements aux bons emplacements
        foreach ($equipements as $el) {
            // Vérifie que l'emplacement existe dans notre tableau indexé
            if (isset($indexed[$el['emplacement_id']])) {
                // Ajoute l'équipement au tableau 'elements' de cet emplacement
                $indexed[$el['emplacement_id']]['elements'][] = [
                    'id' => $el['id'],
                    'nom' => $el['nom']
                ];
            }
        }
        // 🔹 Étape 5 : construction finale de l'arborescence
        // Construire l’arborescence
        $tree = [];
        foreach ($indexed as $id => &$emp) {
            // Si l'emplacement a un parent, on l'ajoute à sa liste de 'children'
            if ($emp['parent_id']) {
                $indexed[$emp['parent_id']]['children'][] = &$emp;
            } else {
                // Sinon c'est une racine, on l'ajoute directement dans l'arbre final
                $tree[] = &$emp;
            }
        }
        // Retourne l’arbre complet, prêt à être converti en JSON
        return $tree;
    }
}