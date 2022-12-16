<?php

namespace ReseauSocial\Lib\DataBase;

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=localhost;dbname=reseausocial', 'root', '');
        }

        return $this->database;
    }
}
?>