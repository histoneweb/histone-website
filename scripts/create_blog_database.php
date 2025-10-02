<?php
/**
 * Create WordPress Blog Database
 */

$config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'port' => 3306,
    'blog_database' => 'histone_blog'
];

echo "==================================\n";
echo "WordPress Blog Database Setup\n";
echo "==================================\n\n";

try {
    $dsn = sprintf('mysql:host=%s;port=%d', $config['host'], $config['port']);
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✓ Connected to MySQL\n";

    // Create blog database
    $sql = "CREATE DATABASE IF NOT EXISTS `{$config['blog_database']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $pdo->exec($sql);

    echo "✓ Database '{$config['blog_database']}' created successfully\n\n";

    echo "Database Details:\n";
    echo "  Database Name: {$config['blog_database']}\n";
    echo "  Username: {$config['username']}\n";
    echo "  Password: (empty)\n";
    echo "  Host: {$config['host']}\n\n";

    echo "✓ Ready for WordPress installation!\n";

} catch (PDOException $e) {
    die("✗ Database error: " . $e->getMessage() . "\n");
}

echo "\n==================================\n";
echo "Setup Complete!\n";
echo "==================================\n";
