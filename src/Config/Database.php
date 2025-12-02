<?php

namespace Src\Config;

use PDO;
use PDOException;

class Database
{
    private $host = "localhost";
    private $dbname = "contacts_app";
    private $user = "root";
    private $pass = "<5XX35NTZ#yt";

    public function connect()
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->pass
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco: " . $e->getMessage());
        }
    }
}
