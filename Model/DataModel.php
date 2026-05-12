<?php

namespace lmd\Model;

class DataModel extends Database
{
    public function __construct()
    {
    }

    public function selectData()
    {
        //Verbindung zur Datenbank herstellen
        $pdo = $this->linkDB();
        //Anfrage SQL-Statement -> SELECT
        $stmt = $pdo->query("SELECT id, userId, description, unit FROM data");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        //Rückgabe verarbeiten
    }

    public function insertData($data)
    {
        $pdo = $this->linkDB();
        $id = $this->createUUID();
        $sql = "INSERT INTO data (id, categoryId, logValue, logDate) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id, $data['categoryId'], $data['logValue'], $data['logDate']]);
        $stmt = $pdo->prepare("SELECT * FROM data WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}