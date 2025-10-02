<?php
/**
 * Database Connection & Schema Verification Script
 *
 * Tests database connectivity and verifies schema integrity
 */

require_once __DIR__ . '/../app/Database.php';

echo "==================================\n";
echo "Database Connection Test\n";
echo "==================================\n\n";

try {
    // Get database instance
    $db = Database::getInstance();

    echo "✓ Database connection successful\n\n";

    // Test query
    if ($db->testConnection()) {
        echo "✓ Database connectivity verified\n\n";
    } else {
        die("✗ Database connectivity test failed\n");
    }

    // Check tables
    echo "Verifying database schema...\n";
    echo "==================================\n";

    $tables = $db->fetchAll("SHOW TABLES");

    $expectedTables = [
        'users',
        'blog_categories',
        'blog_posts',
        'blog_tags',
        'post_tags',
        'blog_comments',
        'contacts',
        'quotes',
        'quote_items',
        'projects_portfolio',
        'email_subscribers',
        'email_campaigns',
        'email_campaign_logs',
        'seo_metadata',
        'seo_redirects',
        'site_settings'
    ];

    $actualTables = array_map(function($row) {
        return current($row);
    }, $tables);

    echo "Tables found: " . count($actualTables) . " / " . count($expectedTables) . "\n\n";

    $missing = array_diff($expectedTables, $actualTables);
    $extra = array_diff($actualTables, $expectedTables);

    if (empty($missing) && empty($extra)) {
        echo "✓ All expected tables exist\n\n";

        // Display table list
        echo "Database Tables:\n";
        foreach ($expectedTables as $table) {
            // Get row count
            $count = $db->fetch("SELECT COUNT(*) as count FROM `$table`");
            echo "  ✓ $table (" . $count['count'] . " rows)\n";
        }

    } else {
        if (!empty($missing)) {
            echo "✗ Missing tables:\n";
            foreach ($missing as $table) {
                echo "  - $table\n";
            }
        }

        if (!empty($extra)) {
            echo "\n⚠ Extra tables:\n";
            foreach ($extra as $table) {
                echo "  + $table\n";
            }
        }
    }

    // Check views
    echo "\nChecking views...\n";
    $views = $db->fetchAll("SHOW FULL TABLES WHERE Table_type = 'VIEW'");

    if (count($views) > 0) {
        echo "✓ Views created: " . count($views) . "\n";
        foreach ($views as $view) {
            echo "  ✓ " . current($view) . "\n";
        }
    } else {
        echo "⚠ No views found\n";
    }

    // Check default data
    echo "\nVerifying default data...\n";
    echo "==================================\n";

    $adminCount = $db->fetch("SELECT COUNT(*) as count FROM users WHERE role = 'admin'");
    echo "Admin users: " . $adminCount['count'] . "\n";

    $categoryCount = $db->fetch("SELECT COUNT(*) as count FROM blog_categories");
    echo "Blog categories: " . $categoryCount['count'] . "\n";

    $settingsCount = $db->fetch("SELECT COUNT(*) as count FROM site_settings");
    echo "Site settings: " . $settingsCount['count'] . "\n";

    if ($adminCount['count'] > 0 && $categoryCount['count'] > 0 && $settingsCount['count'] > 0) {
        echo "\n✓ Default data populated successfully\n";
    } else {
        echo "\n⚠ Some default data may be missing\n";
    }

    echo "\n==================================\n";
    echo "✓ Database verification complete!\n";
    echo "==================================\n";

} catch (Exception $e) {
    echo "\n✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}
