# Histone Solutions - Deployment Guide

This guide explains how to deploy the Histone Solutions website to production.

## Scripts Overview

### 1. `deploy.sh` - Full Deployment Script
Complete deployment process including maintenance mode, Git pull, dependencies, migrations, and optimization.

**Use when:**
- Doing a major release
- Running migrations
- First-time deployment
- Structural changes to the application

### 2. `post-sync.sh` - Quick Post-Sync Script
Lightweight script for quick deployments after code sync (Git webhook, CI/CD).

**Use when:**
- Content updates only
- CSS/JS changes
- View/template updates
- Automatic deployments via webhooks

---

## Setup Instructions

### Step 1: Make Scripts Executable

```bash
chmod +x deploy.sh
chmod +x post-sync.sh
```

### Step 2: Configure Server Environment

Ensure your `.env` file is properly configured for production:

```bash
APP_ENV=production
APP_DEBUG=false
APP_URL=https://histone.com.pk

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Mail (for contact form)
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@histone.com.pk
MAIL_FROM_NAME="Histone Solutions"
```

---

## Usage

### Manual Deployment (Full)

```bash
cd /path/to/histone-website
./deploy.sh
```

**What it does:**
1. ✅ Enables maintenance mode
2. ✅ Pulls latest code from Git (with confirmation)
3. ✅ Installs Composer dependencies (production)
4. ✅ Installs NPM dependencies (if needed)
5. ✅ Clears all caches
6. ✅ Runs database migrations (with confirmation)
7. ✅ Generates sitemap
8. ✅ Sets file permissions
9. ✅ Restarts PHP-FPM (with confirmation)
10. ✅ Disables maintenance mode
11. ✅ Shows deployment summary

**Time:** ~2-3 minutes

---

### Quick Post-Sync Deployment

```bash
cd /path/to/histone-website
./post-sync.sh
```

**What it does:**
1. ✅ Updates Composer dependencies
2. ✅ Clears application caches
3. ✅ Optimizes application
4. ✅ Runs pending migrations (automatic)
5. ✅ Regenerates sitemap
6. ✅ Restarts queue workers
7. ✅ Verifies permissions
8. ✅ Shows deployment summary

**Time:** ~30-60 seconds

---

## Automated Deployment via Git Webhook

### Option 1: Simple Git Hook (Recommended)

Create a post-receive hook on your Git server:

```bash
#!/bin/bash
# .git/hooks/post-receive

cd /path/to/histone-website
./post-sync.sh
```

### Option 2: GitHub Webhook

1. Create a webhook endpoint on your server:

```php
// public/webhook.php
<?php

// Verify secret (recommended)
$secret = env('DEPLOY_WEBHOOK_SECRET');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

if (!hash_equals('sha256=' . hash_hmac('sha256', file_get_contents('php://input'), $secret), $signature)) {
    http_response_code(403);
    exit('Forbidden');
}

// Execute post-sync script
shell_exec('cd ' . base_path() . ' && ./post-sync.sh > /dev/null 2>&1 &');

http_response_code(200);
echo json_encode(['status' => 'success', 'message' => 'Deployment triggered']);
```

2. Configure GitHub webhook:
   - URL: `https://histone.com.pk/webhook.php`
   - Content type: `application/json`
   - Secret: Your secure secret
   - Events: Push to `main` or `laravel-migration` branch

### Option 3: Using Deployer or Laravel Forge

If using Laravel Forge:
1. Go to Site → Deployment
2. Enable Quick Deploy
3. Paste the post-sync script commands

---

## File Permissions

Ensure proper ownership and permissions:

```bash
# Set ownership (www-data is common for Apache/Nginx)
sudo chown -R www-data:www-data /path/to/histone-website

# Set directory permissions
sudo find /path/to/histone-website -type d -exec chmod 755 {} \;

# Set file permissions
sudo find /path/to/histone-website -type f -exec chmod 644 {} \;

# Storage and cache must be writable
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

---

## Cron Jobs

### Sitemap Generation (Daily)

```bash
# Add to crontab: crontab -e
0 2 * * * cd /path/to/histone-website && php artisan sitemap:generate >> /dev/null 2>&1
```

### Laravel Scheduler (Required for queue jobs)

```bash
# Add to crontab: crontab -e
* * * * * cd /path/to/histone-website && php artisan schedule:run >> /dev/null 2>&1
```

---

## Rollback Procedure

If deployment fails or causes issues:

```bash
# 1. Put site in maintenance mode
php artisan down

# 2. Revert to previous Git commit
git log --oneline -n 5  # Find previous commit hash
git reset --hard <previous-commit-hash>

# 3. Run post-sync
./post-sync.sh

# 4. Bring site back up
php artisan up
```

---

## Monitoring & Logs

### Check Deployment Logs

```bash
tail -f storage/logs/laravel.log
tail -f storage/logs/deployments.log
```

### Check Application Status

```bash
php artisan about
php artisan route:list
php artisan config:show
```

### Check Web Server Logs

```bash
# Nginx
sudo tail -f /var/log/nginx/error.log
sudo tail -f /var/log/nginx/access.log

# Apache
sudo tail -f /var/log/apache2/error.log
```

---

## Troubleshooting

### Issue: 500 Internal Server Error

**Solutions:**
```bash
# Clear all caches
php artisan optimize:clear

# Check logs
tail -f storage/logs/laravel.log

# Verify .env file
php artisan config:show

# Check file permissions
ls -la storage
```

### Issue: Database Connection Failed

**Solutions:**
```bash
# Test database connection
php artisan migrate:status

# Verify credentials
cat .env | grep DB_

# Check MySQL is running
sudo systemctl status mysql
```

### Issue: CSS/JS Not Loading

**Solutions:**
```bash
# Clear browser cache

# Generate fresh asset cache
php artisan view:clear
php artisan cache:clear

# Check asset paths
ls -la public/assets/
```

### Issue: Queue Jobs Not Processing

**Solutions:**
```bash
# Check if queue workers are running
ps aux | grep "queue:work"

# Restart queue workers
php artisan queue:restart

# Start queue worker (if not running)
php artisan queue:work --daemon
```

---

## Security Checklist

Before going live:

- [ ] `APP_DEBUG=false` in `.env`
- [ ] `APP_ENV=production` in `.env`
- [ ] Strong `APP_KEY` generated
- [ ] Database credentials secured
- [ ] File permissions set correctly
- [ ] `.env` file not in Git
- [ ] HTTPS/SSL configured
- [ ] Firewall rules configured
- [ ] Regular backups scheduled
- [ ] Error reporting to logs only

---

## Backup Strategy

### Database Backup (Daily)

```bash
#!/bin/bash
# backup-db.sh

TIMESTAMP=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backups/histone-website"
DB_NAME="your_database"

mkdir -p $BACKUP_DIR

mysqldump -u your_username -p'your_password' $DB_NAME | gzip > $BACKUP_DIR/db_$TIMESTAMP.sql.gz

# Keep only last 7 days
find $BACKUP_DIR -name "db_*.sql.gz" -mtime +7 -delete
```

### Full Backup (Weekly)

```bash
#!/bin/bash
# backup-full.sh

TIMESTAMP=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backups/histone-website"
APP_DIR="/path/to/histone-website"

mkdir -p $BACKUP_DIR

tar -czf $BACKUP_DIR/full_$TIMESTAMP.tar.gz \
    --exclude='vendor' \
    --exclude='node_modules' \
    --exclude='storage/logs' \
    $APP_DIR

# Keep only last 4 weeks
find $BACKUP_DIR -name "full_*.tar.gz" -mtime +28 -delete
```

---

## Support

For deployment issues, contact:
- **Email**: info@histone.com.pk
- **Phone**: +92 333 5508040

---

## Additional Resources

- [Laravel Deployment Documentation](https://laravel.com/docs/deployment)
- [Laravel Forge](https://forge.laravel.com/) - Automated deployment service
- [Envoyer](https://envoyer.io/) - Zero-downtime deployment
