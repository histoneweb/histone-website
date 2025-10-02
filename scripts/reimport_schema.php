<?php
/**
 * Database Schema Re-Import Script
 *
 * Properly imports the full schema.sql file
 */

$config = [
    'host' => 'localhost',
    'database' => 'histone',
    'username' => 'root',
    'password' => '',
    'port' => 3306
];

$schemaFile = __DIR__ . '/../database/schema.sql';

echo "==================================\n";
echo "Database Schema Re-Import\n";
echo "==================================\n\n";

if (!file_exists($schemaFile)) {
    die("Error: Schema file not found\n");
}

try {
    // Connect to MySQL
    $dsn = sprintf('mysql:host=%s;port=%d', $config['host'], $config['port']);
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✓ Connected to MySQL\n";

    // Drop and recreate database for clean slate
    echo "Dropping existing database...\n";
    $pdo->exec("DROP DATABASE IF EXISTS `{$config['database']}`");
    echo "✓ Database dropped\n";

    echo "Creating fresh database...\n";
    $pdo->exec("CREATE DATABASE `{$config['database']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✓ Database created\n";

    // Select database
    $pdo->exec("USE `{$config['database']}`");
    echo "✓ Switched to database\n\n";

    // Read entire schema file
    $schema = file_get_contents($schemaFile);

    // Execute the entire schema as one multi-query
    echo "Executing schema file...\n";
    $pdo->exec($schema);

    echo "✓ Schema executed successfully\n\n";

    // Verify tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "Tables created (" . count($tables) . "):\n";
    foreach ($tables as $table) {
        $countStmt = $pdo->query("SELECT COUNT(*) FROM `$table`");
        $count = $countStmt->fetchColumn();
        echo "  ✓ $table ($count rows)\n";
    }

    // Check views
    $viewStmt = $pdo->query("SHOW FULL TABLES WHERE Table_type = 'VIEW'");
    $views = $viewStmt->fetchAll(PDO::FETCH_COLUMN);

    if (count($views) > 0) {
        echo "\nViews created (" . count($views) . "):\n";
        foreach ($views as $view) {
            echo "  ✓ $view\n";
        }
    }

    echo "\n==================================\n";
    echo "✓ Import complete!\n";
    echo "==================================\n";

} catch (PDOException $e) {
    die("\n✗ Database error: " . $e->getMessage() . "\n");
}
