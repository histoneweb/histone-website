<?php
/**
 * Database Schema Import Script
 *
 * Run this script to import the database schema into MySQL
 * Usage: php scripts/import_schema.php
 */

// Database configuration
$config = [
    'host' => 'localhost',
    'database' => 'histone',
    'username' => 'root',
    'password' => '',
    'port' => 3306
];

$schemaFile = __DIR__ . '/../database/schema.sql';

echo "==================================\n";
echo "Database Schema Import Script\n";
echo "==================================\n\n";

// Check if schema file exists
if (!file_exists($schemaFile)) {
    die("Error: Schema file not found at: $schemaFile\n");
}

echo "Schema file found: $schemaFile\n";
echo "Reading schema...\n";

$schema = file_get_contents($schemaFile);

if ($schema === false) {
    die("Error: Failed to read schema file\n");
}

echo "Schema file size: " . strlen($schema) . " bytes\n\n";

try {
    // Connect to MySQL server (without database)
    $dsn = sprintf('mysql:host=%s;port=%d', $config['host'], $config['port']);
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to MySQL server successfully\n";

    // Create database if not exists
    $createDbSql = sprintf(
        "CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci",
        $config['database']
    );

    $pdo->exec($createDbSql);
    echo "Database '{$config['database']}' created/verified\n";

    // Select the database
    $pdo->exec("USE `{$config['database']}`");
    echo "Switched to database '{$config['database']}'\n\n";

    // Split schema into individual statements
    $statements = array_filter(
        array_map('trim', explode(';', $schema)),
        function($stmt) {
            return !empty($stmt) && !preg_match('/^--/', $stmt);
        }
    );

    echo "Executing " . count($statements) . " SQL statements...\n\n";

    $successCount = 0;
    $errorCount = 0;

    foreach ($statements as $index => $statement) {
        try {
            $pdo->exec($statement);

            // Extract table name for display
            if (preg_match('/CREATE TABLE\s+`?(\w+)`?/i', $statement, $matches)) {
                echo "✓ Created table: {$matches[1]}\n";
            } elseif (preg_match('/ALTER TABLE\s+`?(\w+)`?/i', $statement, $matches)) {
                echo "✓ Altered table: {$matches[1]}\n";
            } else {
                echo "✓ Executed statement " . ($index + 1) . "\n";
            }

            $successCount++;
        } catch (PDOException $e) {
            echo "✗ Error in statement " . ($index + 1) . ": " . $e->getMessage() . "\n";
            $errorCount++;
        }
    }

    echo "\n==================================\n";
    echo "Import Summary\n";
    echo "==================================\n";
    echo "Total statements: " . count($statements) . "\n";
    echo "Successful: $successCount\n";
    echo "Errors: $errorCount\n";

    if ($errorCount === 0) {
        echo "\n✓ Schema imported successfully!\n";

        // Verify tables
        echo "\nVerifying tables...\n";
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

        echo "Tables created (" . count($tables) . "):\n";
        foreach ($tables as $table) {
            echo "  - $table\n";
        }
    } else {
        echo "\n✗ Import completed with errors\n";
    }

} catch (PDOException $e) {
    die("\nDatabase error: " . $e->getMessage() . "\n");
}

echo "\n==================================\n";
echo "Import complete!\n";
echo "==================================\n";
