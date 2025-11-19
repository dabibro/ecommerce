<?php
/**
 * Created by PhpStorm.
 * User: Dauda Ibrahim
 * Date: 11/10/2023
 * Time: 01:43 PM
 */

namespace App\DB;


use Dotenv\Dotenv;
use mysqli;

abstract class MysqliConn extends Tables
{
    protected $DBHost;
    protected $DBUsername;
    protected $DBPassword;
    public $DBName;
    protected $conn;

    public function __construct()
    {
        parent::__construct();
        $env = Dotenv::createImmutable(__DIR__ . '../../../');
        $env->load();
        $this->DBHost = $_ENV['DB_HOST'];
        $this->DBUsername = $_ENV['DB_USER'];
        $this->DBPassword = $_ENV['DB_PASSWORD'];
        $this->DBName = $_ENV['DB_NAME'];
    }

    public function openConnection()
    {
        $this->conn = new mysqli($this->DBHost, $this->DBUsername, $this->DBPassword, $this->DBName);
        if ($this->conn->connect_error) {
            die("There is some problem in connection: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

    public function closeConnection()
    {
        $this->conn->close();
        $this->conn = null;
    }
}