<?php

namespace Models;

use Classes\Connection;
use PDO;
class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    public function get()
    {
        $query = "SELECT * FROM users";

        $statement = ($this->conn->query($query))->fetchAll(PDO::FETCH_OBJ);

        return $statement;
    }

    public function insert($request)
    {
        $query_string = $this->getQueryString($request, __FUNCTION__);
        $columns = $query_string['columns'];
        $values = $query_string['values'];
        
        $new_user = $this->conn->query("INSERT INTO users ($columns) VALUES ($values)");
        $id = $this->conn->query('SELECT last_insert_rowid()')->fetchColumn();

        return $id;
    }

    public function update($request, $id)
    {
        $query_string = $this->getQueryString($request, __FUNCTION__)['query_string'];
        $update_user = $this->conn->query("UPDATE users SET $query_string WHERE `id` = $id");

        return $update_user;
    }

    public function delete($id)
    {
        $delete = $this->conn->query("DELETE FROM users WHERE id = $id");

        return $delete;
    }

    public function getQueryString($query_array, $action)
    {
        $count = 0;
        $total = count($query_array);
        $columns = '';
        $values = '';
        $query_string = '';


        foreach ($query_array as $key => $value) {
            $count++;
            if ($action == 'insert') {
                $columns .= $count < $total ? "'$key', " : "'$key'";
                $values .= $count < $total ? "'$value', " : "'$value'";
            } else {
                $comma = $count < $total ? ', ' : '';
                $query_string .= "`$key`  =  '$value'  $comma";
            }
        }

        return [
            'columns' => $columns,
            'values' => $values,
            'query_string' => $query_string
        ];
    }
}