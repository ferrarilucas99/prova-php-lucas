<?php

namespace Models;

use Classes\Connection;
use PDO;
class Color
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    public function get()
    {
        $query = "SELECT * FROM colors";

        $statement = ($this->conn->query($query))->fetchAll(PDO::FETCH_OBJ);

        return $statement;
    }
}