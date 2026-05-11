<?php

namespace lmd\Model;



class CategoryModel extends Database
{

    public function __construct() {}

    public function selectCategory()
    {
        //Verbindung zur Datenbank herstellen
        $pdo = $this->linkDB();
        //Anfrage SQL-Statement -> SELECT
        $stmt = $pdo->query("SELECT id, userId, description, unit FROM category");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        //Rückgabe verarbeiten
    }
}
