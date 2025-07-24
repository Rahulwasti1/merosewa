<?php
class Database
{
    private $host = 'localhost';
    private $db_name = 'merosewa';
    private $username = 'root';
    private $password = '';
    private $conn;
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password, $this->options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getcode());
        }
    }

    /**
     * Select multiple rows
     * @param string $query SQL query with parameters
     * @param array $params Parameters for prepared statement
     * @return array Array of rows
     */
    public function selectAll(string $query, array $params = []): array
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            throw new \PDOException("SelectAll failed: " . $e->getMessage());
        }
    }

    /**
     * Select single row
     * @param string $query SQL query with parameters
     * @param array $params Parameters for prepared statement
     * @return array|null Single row or null if not found
     */
    public function selectFirst(string $query, array $params = []): ?array
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch() ?: null;
        } catch (\PDOException $e) {
            throw new \PDOException("SelectFirst failed: " . $e->getMessage());
        }
    }

    /**
     * Insert a new record
     * @param string $query SQL query with parameters
     * @param array $params Parameters for prepared statement
     * @return int Last inserted ID
     */
    public function insert(string $query, array $params = []): int
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $this->conn->lastInsertId();
        } catch (\PDOException $e) {
            throw new \PDOException("Insert failed: " . $e->getMessage());
        }
    }
    /**
     * Update existing record(s)
     * @param string $query SQL query with parameters
     * @param array $params Parameters for prepared statement
     * @return int Number of affected rows
     */
    public function update(string $query, array $params = []): int
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \PDOException("Update failed: " . $e->getMessage());
        }
    }

    /**
     * Delete record(s)
     * @param string $query SQL query with parameters
     * @param array $params Parameters for prepared statement
     * @return int Number of affected rows
     */
    public function delete(string $query, array $params = []): int
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \PDOException("Delete failed: " . $e->getMessage());
        }
    }

    /**
     * Get the PDO connection instance
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
