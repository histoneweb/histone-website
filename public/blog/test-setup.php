<?php
/**
 * WordPress Installation Status Check
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WordPress Setup Check</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .status-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .success { color: #28a745; }
        .error { color: #dc3545; }
        .warning { color: #ffc107; }
        .info { color: #17a2b8; }
        h1 { color: #333; }
        .step {
            margin: 20px 0;
            padding: 15px;
            border-left: 4px solid #007bff;
            background: #f8f9fa;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 5px 0 0;
        }
        .btn:hover {
            background: #0056b3;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="status-box">
        <h1>🔧 WordPress Installation Status</h1>

        <?php
        // Check 1: Database Connection
        echo '<div class="step">';
        echo '<h2>1. Database Connection</h2>';

        try {
            require_once('wp-config.php');

            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            if ($mysqli->connect_error) {
                echo '<p class="error">✗ Database connection failed: ' . $mysqli->connect_error . '</p>';
            } else {
                echo '<p class="success">✓ Database connection successful</p>';
                echo '<p>Database: <code>' . DB_NAME . '</code></p>';

                // Check 2: WordPress Tables
                echo '<h2>2. WordPress Installation</h2>';

                $result = $mysqli->query("SHOW TABLES LIKE 'wp_%'");
                $table_count = $result->num_rows;

                if ($table_count > 0) {
                    echo '<p class="success">✓ WordPress is installed (' . $table_count . ' tables found)</p>';

                    // Check if there are posts
                    $posts = $mysqli->query("SELECT COUNT(*) as count FROM wp_posts WHERE post_type='post' AND post_status='publish'");
                    $post_row = $posts->fetch_assoc();

                    echo '<p class="info">Published posts: ' . $post_row['count'] . '</p>';

                    if ($post_row['count'] > 0) {
                        echo '<p class="success">✓ Blog has published posts</p>';
                        echo '<p><a href="index.php" class="btn">View Blog</a></p>';
                    } else {
                        echo '<p class="warning">⚠ No published posts yet</p>';
                        echo '<p><a href="wp-admin/" class="btn">Go to Admin Dashboard</a></p>';
                    }
                } else {
                    echo '<p class="error">✗ WordPress is NOT installed (no tables found)</p>';
                    echo '<h3>Action Required:</h3>';
                    echo '<p>WordPress needs to be installed. Click the button below:</p>';
                    echo '<p><a href="wp-admin/install.php" class="btn">Start WordPress Installation</a></p>';

                    echo '<h3>Installation Steps:</h3>';
                    echo '<ol>';
                    echo '<li>Click "Start WordPress Installation" button above</li>';
                    echo '<li>Fill in the form:
                        <ul>
                            <li><strong>Site Title:</strong> Histone Solutions Blog</li>
                            <li><strong>Username:</strong> awais</li>
                            <li><strong>Password:</strong> (choose a strong password)</li>
                            <li><strong>Email:</strong> awaisnaseem1@gmail.com</li>
                            <li><strong>Search Engine Visibility:</strong> Uncheck (allow indexing)</li>
                        </ul>
                    </li>';
                    echo '<li>Click "Install WordPress"</li>';
                    echo '<li>Login with your credentials</li>';
                    echo '</ol>';
                }

                $mysqli->close();
            }
        } catch (Exception $e) {
            echo '<p class="error">✗ Error: ' . $e->getMessage() . '</p>';
        }
        echo '</div>';
        ?>

        <div class="step">
            <h2>3. Current Blog URL</h2>
            <p>Main Blog: <a href="index.php">index.php</a></p>
            <p>Admin: <a href="wp-admin/">wp-admin/</a></p>
            <p>Installation: <a href="wp-admin/install.php">wp-admin/install.php</a></p>
        </div>

        <div class="step">
            <h2>4. Next Steps After Installation</h2>
            <ol>
                <li>Install <strong>Yoast SEO</strong> plugin</li>
                <li>Install a theme (GeneratePress recommended)</li>
                <li>Go to Settings → Permalinks → Select "Post name"</li>
                <li>Add your 3 blog posts from <code>docs/blog_posts/</code></li>
            </ol>
        </div>

        <p style="margin-top: 30px;">
            <a href="../index.html" class="btn">← Back to Main Site</a>
        </p>
    </div>
</body>
</html>
