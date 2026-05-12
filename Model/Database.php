<?php

namespace lmd\Model;

use lmd\Library\Msg;

abstract class Database {
    /**
     * Stellt eine Verbindung zur Datenbank her
     *
     * @return \PDO Gibt eine Datenbankverbindung zurueck
     */
    public function linkDB() {
        $env = parse_ini_file(__DIR__ . '/../.env');

        try {
            return new \PDO(
                "mysql:dbname={$env['DB_NAME']};host={$env['DB_HOST']}",
                $env['DB_USER'],
                $env['DB_PASS'],
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );
        } catch (\PDOException $e) {
            new Msg(true, null, $e);
        }
    }

    /**
     * Zum serverseitigen generieren einer UUID
     * 
     * @return string Liefert eine UUID
     */
    public function createUUID()
    {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    } 
}