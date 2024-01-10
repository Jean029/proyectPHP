<?php

class DB
{
    /**
     * @var string
     */
    private $servername = "localhost";
    /**
     * @var string
     */
    private $username = "root";
    /**
     * @var string
     */
    private $password = "";
    /**
     * @var string
     */
    private $dbname = "matricula";
    /**
     * @var mysqli
     */
    private $conn;

    public function start_connection()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
    }

    /**
     * @param string $query
     * @return mysqli_result | string | bool
     */
    public function run_query($query)
    {
        try {
            return mysqli_query($this->conn, $query);
        } catch (Exception $e) {
            return $this->conn->error;
        }
    }

    public function prepare_query($query)
    {
        return $this->conn->prepare($query);
    }

    public function close_connection()
    {
        $this->conn->close();
    }
}
