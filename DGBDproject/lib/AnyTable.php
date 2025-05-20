<?php

class AnyTable {

    private $conn;

    public $table = '';
    public $identName = '';
    public $identValue = '';
    public $fields = [];

    /*
       Constructeur
     ------------
     $db : bases de données -> string
     $table : table -> string
     $identName : nom de la clé primaire (optionnel : uniquement utilisable pour fetchOne et delete)
     $identValue : valeur de la clé primaire (optionnel : uniquement utilisable avec fectOne et delete)
     $fields : noms des champs de la table -> array associatif (optionnel uniquement utilisable avec postData et putData)

 */

    public function __construct($db, $table = '', $identName = '', $identValue = '', $fields = [])
    {
        $this->conn = $db;
        $this->table = $table;
        $this->identName = $identName;
        $this->identValue = $identValue;
        $this->fields = $fields;
    }


    //Récupérer tout les enregistrement d'une table
    public function fetchAll()
    {

        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table);
        $stmt->execute();
        return $stmt;
    }

    //Récupérer 1 entregistrement d'une table selon un id donné
    public function fetchOne()
    {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->identName.' = ?');
        $stmt->bindParam(1, $this->identValue);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($this->fields as $field) {
                $this->$field = $row[$field];
            }
            return true;
        }
        return false;
    }

    //Ajouter un enregistrement
    public function postData()
    {
        $fields = '';
        $values = '';
        foreach ($this->fields as $field) {
            $fields .= $field.',';
            $values .= ':'.$field.',';
        }
        $fields = rtrim($fields, ',');
        $values = rtrim($values, ',');
        $stmt = $this->conn->prepare('INSERT INTO '.$this->table.' ('.$fields.') VALUES ('.$values.')');
        foreach ($this->fields as $field) {
            $stmt->bindParam(':'.$field, $this->$field);
        }
        if ($stmt->execute()) {
            return true;
        }
        return false;

    }

    public function putData()
    {
        $fields = '';
        foreach ($this->fields as $field) {
            $fields .= $field.' = :'.$field.',';
        }
        $fields = rtrim($fields, ',');
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET {$fields} WHERE {$this->identName} = {$this->identValue}");
        foreach ($this->fields as $field) {
            $stmt->bindParam(':'.$field, $this->$field);
        }
        if ($stmt->execute()) {
            return true;
        }}

    public function deleteData()
    {
        $stmt = $this->conn->prepare('DELETE FROM '.$this->table.' WHERE '.$this->identName.' = ?');
        $stmt->bindParam(1, $this->identValue);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


}


?>
