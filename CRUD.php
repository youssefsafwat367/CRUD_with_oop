<?php
class database
{
    public $connection;
    public const SERVERNAME = 'localhost';
    public const DATABASE = 'tasks';
    public const USERNAME = 'root';
    public const PASSWORD = "";
    public function __construct()
    {
        $this->connection = new PDO("mysql:host=" . self::SERVERNAME . ";dbname=" . self::DATABASE, self::USERNAME, self::PASSWORD);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    public function getusers($columns, $table_name, $condition = true)
    {
        $array = [];
        foreach ($columns as $column) {
            if ($column == "*") {
                $array[] = "*";
            } else {
                $array[] = "`$column`";
            }
        }
        $user = implode(", ", $array);
        $query = "SELECT $user FROM $table_name where $condition";
        $sql = $this->connection->query($query);
        return $sql->fetchAll();
    }
    public function update_user($columns, $table_name, $condition = true)
    {
        $array = [];
        foreach ($columns as $key => $column) {
            $array[] = "`$key` " . " = " . "'$column'";
        }
        $update = implode(",", $array);
        $query = "UPDATE $table_name SET $update WHERE $condition";
        $sql = $this->connection->prepare($query);
        return $sql->execute();
    }
    public function delete_user($table_name, $condition = true)
    {
        $query = "DELETE FROM $table_name WHERE $condition";
        $sql = $this->connection->prepare($query);
        return $sql->execute();
    }
}
$user = new database();
