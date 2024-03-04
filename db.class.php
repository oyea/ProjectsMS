<?php
class Db
{
    private $host;
    private $username;
    private $password;
    private $database;
    public $connection;
    public $titleError = [];
    public $error = "";
    public $count = 0;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connect();
    }

    private function connect()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function create($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $values = array_values($data);

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $statement = $this->connection->prepare($sql);
        $statement->bind_param(str_repeat("s", count($values)), ...$values);

        if ($statement->execute()) {
            return $statement->insert_id;
        } else {
            if ($this->connection->errno === 1062) {
                $this->titleError = ['titerr' => 'Project With this Title already exists'];
            } else {
                $this->error =  "Error: " . $this->connection->error;
            }
            return false;
        }
    }

    public function read($table, $condition = '', $params = array(), $limit = null, $offset = null, $orderby = null)
    {
        $sql = "SELECT * FROM $table";
        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }
        if (!empty($orderby)) {
            $sql .= " ORDER BY $orderby DESC";
        }
        if (!empty($limit)) {
            $sql .= " LIMIT $limit";
        }
        if (!empty($offset)) {
            $sql .= " OFFSET $offset";
        }

        $statement = $this->connection->prepare($sql);
        if (!empty($params)) {
            $statement->bind_param(str_repeat("s", count($params)), ...$params);
        }

        $statement->execute();
        $result = $statement->get_result();

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $this->count = count($rows); // Update the count variable
        return $rows;
    }

    public function update($table, $data, $condition, $params = array())
    {
        $setStatements = array();
        $values = array_values($data);
        foreach ($data as $column => $value) {
            $setStatements[] = "$column = ?";
        }

        $sql = "UPDATE $table SET " . implode(", ", $setStatements) . " WHERE $condition";
        $statement = $this->connection->prepare($sql);
        $statement->bind_param(str_repeat("s", count($values) + count($params)), ...$values, ...$params);

        if ($statement->execute()) {
            return $statement->execute();
        } else {
            if ($this->connection->errno === 1062) {
                $this->titleError = ['titerr' => 'Project with this Title already exists go back to fix it'];
            }
            $this->error =  "Error: " . $this->connection->error;
            return false;
        }
    }


    public function delete($table, $condition, $params = array())
    {
        $sql = "DELETE FROM $table WHERE $condition";
        $statement = $this->connection->prepare($sql);
        $statement->bind_param(str_repeat("s", count($params)), ...$params);

        return $statement->execute();
    }



    public function close()
    {
        $this->connection->close();
    }

    public function customsql($sql, $params = array())
    {
        $statement = $this->connection->prepare($sql);
        if (!empty($params)) {
            $statement->bind_param(str_repeat("s", count($params)), ...$params);
        }

        if ($statement->execute()) {
            $result = $statement->get_result();
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $this->count = count($rows); // Update the count variable
            return $rows;
        } else {
            // Handle the error if needed
            return false;
        }
    }
}
