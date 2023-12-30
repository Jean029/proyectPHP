<?php

class DB
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "matricula";
    private $conn;

    public function start_connection()
    {
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
    }

    public function run_query($query)
    {
        return mysqli_query($this->conn, $query);
    }

    public function prepare_query($query)
    {
        return $this->conn->prepare($query);
    }
}
