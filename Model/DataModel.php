<?php

namespace lmd\Model;

use lmd\Library\Msg;

class DataModel extends Database
{
    public function __construct()
    {
    }

    public function selectData($categoryId = null, $logDate = null)
    {
        try {
            $pdo = $this->linkDB();
            $sql = "SELECT id, userId, description, unit FROM data";
            $params = [];
            if ($categoryId !== null) {
                $sql .= " WHERE categoryId = ?";
                $params[] = $categoryId;
            }
            if ($logDate !== null) {
                $sql .= $categoryId !== null ? " AND logDate = ?" : " WHERE logDate = ?";
                $params[] = $logDate;
            }
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $ex) {
            return new Msg(true, null, $ex->getMessage());
        }
    }

    public function insertData($data)
    {
        try {
            $pdo = $this->linkDB();
            $id = $this->createUUID();
            $sql = "INSERT INTO data (id, categoryId, logValue, logDate) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id, $data['categoryId'], $data['logValue'], $data['logDate']]);
            return new Msg(false);
        } catch (\PDOException $ex) {
            return new Msg(true, null, $ex->getMessage());
        }

    }


}