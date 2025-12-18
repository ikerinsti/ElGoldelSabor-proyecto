<?php

class Database {
    public static function connect($host = 'localhost', $db='el_gol_del_sabor', $user='root', $pass='') {
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else {
            return $conn;
        }
    }
}
?>