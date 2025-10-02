<?php
/**
 * Database Connection Test Page
 *
 * Simple page to verify database connectivity from web browser
 */

require_once __DIR__ . '/../app/Database.php';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Test - Histone Solutions</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .status {
            margin: 20px 0;
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 1rem;
        }

        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #667eea;
            color: white;
            font-weight: 600;
        }

        tr:hover {
            background: #f5f5f5;
        }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .back-link:hover {
            background: #5568d3;
        }

        .metric {
            display: inline-block;
            margin: 10px 20px 10px 0;
            padding: 10px 20px;
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            border-radius: 5px;
        }

        .metric strong {
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗄️ Database Connection Test</h1>

        <?php
        try {
            // Get database instance
            $db = Database::getInstance();

            echo '<div class="status success">✓ Database connection successful!</div>';

            // Get database info
            $dbInfo = $db->fetch("SELECT DATABASE() as db_name, VERSION() as version");

            echo '<div class="info">';
            echo '<strong>Database:</strong> ' . htmlspecialchars($dbInfo['db_name']) . '<br>';
            echo '<strong>MySQL Version:</strong> ' . htmlspecialchars($dbInfo['version']);
            echo '</div>';

            // Get table statistics
            $tables = $db->fetchAll("
                SELECT
                    TABLE_NAME,
                    TABLE_ROWS,
                    ROUND(((DATA_LENGTH + INDEX_LENGTH) / 1024 / 1024), 2) AS size_mb
                FROM information_schema.TABLES
                WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_TYPE = 'BASE TABLE'
                ORDER BY TABLE_NAME
            ");

            echo '<h2 style="margin-top: 30px;">Database Tables</h2>';

            $totalRows = 0;
            $totalSize = 0;

            echo '<table>';
            echo '<thead><tr><th>Table Name</th><th>Rows</th><th>Size (MB)</th></tr></thead>';
            echo '<tbody>';

            foreach ($tables as $table) {
                $totalRows += $table['TABLE_ROWS'];
                $totalSize += $table['size_mb'];

                echo '<tr>';
                echo '<td>' . htmlspecialchars($table['TABLE_NAME']) . '</td>';
                echo '<td>' . number_format($table['TABLE_ROWS']) . '</td>';
                echo '<td>' . number_format($table['size_mb'], 2) . '</td>';
                echo '</tr>';
            }

            echo '</tbody></table>';

            echo '<div class="metric"><strong>Total Tables:</strong> ' . count($tables) . '</div>';
            echo '<div class="metric"><strong>Total Rows:</strong> ' . number_format($totalRows) . '</div>';
            echo '<div class="metric"><strong>Total Size:</strong> ' . number_format($totalSize, 2) . ' MB</div>';

            // Show sample data
            $categories = $db->fetchAll("SELECT name, slug FROM blog_categories LIMIT 5");

            if (!empty($categories)) {
                echo '<h2 style="margin-top: 30px;">Sample Data: Blog Categories</h2>';
                echo '<table>';
                echo '<thead><tr><th>Category Name</th><th>Slug</th></tr></thead>';
                echo '<tbody>';

                foreach ($categories as $cat) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($cat['name']) . '</td>';
                    echo '<td>' . htmlspecialchars($cat['slug']) . '</td>';
                    echo '</tr>';
                }

                echo '</tbody></table>';
            }

            $settings = $db->fetchAll("SELECT setting_key, setting_value, category FROM site_settings ORDER BY category, setting_key LIMIT 10");

            if (!empty($settings)) {
                echo '<h2 style="margin-top: 30px;">Site Settings (Sample)</h2>';
                echo '<table>';
                echo '<thead><tr><th>Setting Key</th><th>Value</th><th>Category</th></tr></thead>';
                echo '<tbody>';

                foreach ($settings as $setting) {
                    $value = $setting['setting_value'];
                    if (strlen($value) > 50) {
                        $value = substr($value, 0, 50) . '...';
                    }

                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($setting['setting_key']) . '</td>';
                    echo '<td>' . htmlspecialchars($value) . '</td>';
                    echo '<td>' . htmlspecialchars($setting['category']) . '</td>';
                    echo '</tr>';
                }

                echo '</tbody></table>';
            }

        } catch (Exception $e) {
            echo '<div class="status error">✗ Database connection failed: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
        ?>

        <a href="index.html" class="back-link">← Back to Home</a>
    </div>
</body>
</html>
