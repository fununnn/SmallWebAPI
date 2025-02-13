<?php
namespace Database;
use mysqli;
use Helpers\Settings;

class MySQLWrapper extends mysqli {
    public function __construct(?string $hostname = 'localhost', ?string $username = null, ?string $password = null, ?string $database = null, ?int $port = null, ?string $socket = null)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $username = $username ?? Settings::env('DATABASE_USER');
        $password = $password ?? Settings::env('DATABASE_USER_PASSWORD');
        $database = $database ?? Settings::env('DATABASE_NAME');
        parent::__construct($hostname, $username, $password, $database, $port, $socket);
        if ($this->connect_errno) {
            throw new \Exception("Failed to connect to MySQL: (" . $this->connect_errno . ") " . $this->connect_error);
        }
        echo "Connected successfully to database: " . $this->getDatabaseName() . PHP_EOL;
    }

    public function getDatabaseName(): string {
        $result = $this->query("SELECT database() AS the_db");
        if ($result === false) {
            throw new \Exception("Failed to get database name: " . $this->error);
        }
        $row = $result->fetch_row();
        return $row[0];
    }
}