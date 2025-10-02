<?php
/**
 * Database Connection Class
 *
 * Singleton pattern for MySQL database connection using PDO
 */

class Database {
    private static $instance = null;
    private $connection;
    private $config;

    /**
     * Private constructor to prevent direct instantiation
     */
    private function __construct() {
        $this->config = require __DIR__ . '/../config/database.php';
        $this->connect();
    }

    /**
     * Get singleton instance
     *
     * @return Database
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Establish database connection
     *
     * @return void
     */
    private function connect() {
        try {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s;port=%d',
                $this->config['host'],
                $this->config['database'],
                $this->config['charset'],
                $this->config['port']
            );

            $this->connection = new PDO(
                $dsn,
                $this->config['username'],
                $this->config['password'],
                $this->config['options']
            );

        } catch (PDOException $e) {
            // Log error and display user-friendly message
            error_log('Database connection error: ' . $e->getMessage());
            throw new Exception('Database connection failed. Please check configuration.');
        }
    }

    /**
     * Get PDO connection instance
     *
     * @return PDO
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * Execute a prepared statement query
     *
     * @param string $sql SQL query
     * @param array $params Query parameters
     * @return PDOStatement
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log('Query error: ' . $e->getMessage());
            throw new Exception('Database query failed.');
        }
    }

    /**
     * Get single row
     *
     * @param string $sql SQL query
     * @param array $params Query parameters
     * @return array|false
     */
    public function fetch($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }

    /**
     * Get all rows
     *
     * @param string $sql SQL query
     * @param array $params Query parameters
     * @return array
     */
    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }

    /**
     * Insert data and return last insert ID
     *
     * @param string $sql SQL query
     * @param array $params Query parameters
     * @return string Last insert ID
     */
    public function insert($sql, $params = []) {
        $this->query($sql, $params);
        return $this->connection->lastInsertId();
    }

    /**
     * Execute update/delete and return affected rows
     *
     * @param string $sql SQL query
     * @param array $params Query parameters
     * @return int Number of affected rows
     */
    public function execute($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    /**
     * Begin transaction
     *
     * @return bool
     */
    public function beginTransaction() {
        return $this->connection->beginTransaction();
    }

    /**
     * Commit transaction
     *
     * @return bool
     */
    public function commit() {
        return $this->connection->commit();
    }

    /**
     * Rollback transaction
     *
     * @return bool
     */
    public function rollback() {
        return $this->connection->rollBack();
    }

    /**
     * Test database connection
     *
     * @return bool
     */
    public function testConnection() {
        try {
            $this->connection->query('SELECT 1');
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Prevent cloning of the instance
     */
    private function __clone() {}

    /**
     * Prevent unserializing of the instance
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}
