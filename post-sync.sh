#!/bin/bash

###############################################################################
# Histone Solutions Website - Post-Sync Script
###############################################################################
# This script runs after code sync (e.g., from Git webhook, CI/CD pipeline)
# Optimized for quick execution without full deployment
# Usage: ./post-sync.sh
###############################################################################

set -e  # Exit on any error

echo "=========================================="
echo "Histone Solutions - Post-Sync Running"
echo "=========================================="
echo ""

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Function to print colored output
print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

# Timestamp
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')
echo "Started at: $TIMESTAMP"
echo ""

###############################################################################
# Check if we're in the correct directory
###############################################################################
if [ ! -f "artisan" ]; then
    print_error "Error: artisan file not found. Are you in the Laravel project root?"
    exit 1
fi

###############################################################################
# Step 1: Install/Update Composer dependencies (production only)
###############################################################################
echo "Step 1: Updating Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --quiet
print_success "Composer dependencies updated"
echo ""

###############################################################################
# Step 2: Clear caches
###############################################################################
echo "Step 2: Clearing application caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
print_success "Caches cleared"
echo ""

###############################################################################
# Step 3: Optimize for production
###############################################################################
echo "Step 3: Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
print_success "Application optimized"
echo ""

###############################################################################
# Step 4: Run database migrations (if any)
###############################################################################
echo "Step 4: Checking for database migrations..."
if php artisan migrate:status | grep -q "Pending"; then
    print_warning "Pending migrations found - running migrations..."
    php artisan migrate --force
    print_success "Migrations completed"
else
    print_success "No pending migrations"
fi
echo ""

###############################################################################
# Step 5: Seed blog author (ensures author exists before syncing)
###############################################################################
echo "Step 5: Creating/updating blog author..."
php artisan db:seed --class=BlogAuthorSeeder --force > /dev/null 2>&1 || true
print_success "Blog author seeded"
echo ""

###############################################################################
# Step 6: Sync blog content (if exported file exists)
###############################################################################
echo "Step 6: Syncing blog content..."
if [ -f "storage/app/blog-sync/blog-content.json" ]; then
    php artisan blog:sync --force
    print_success "Blog content synced"
else
    print_warning "No blog content file found - skipping sync"
fi
echo ""

###############################################################################
# Step 7: Regenerate sitemap
###############################################################################
echo "Step 7: Regenerating sitemap..."
php artisan sitemap:generate > /dev/null 2>&1 || true
print_success "Sitemap regenerated"
echo ""

###############################################################################
# Step 8: Restart queue workers (if running)
###############################################################################
echo "Step 8: Checking queue workers..."
if pgrep -f "artisan queue:work" > /dev/null; then
    php artisan queue:restart
    print_success "Queue workers restarted"
else
    print_warning "No queue workers running"
fi
echo ""

###############################################################################
# Step 9: Fix storage permissions (if needed)
###############################################################################
echo "Step 9: Verifying storage permissions..."
find storage bootstrap/cache -type d -exec chmod 775 {} \; 2>/dev/null || true
find storage bootstrap/cache -type f -exec chmod 664 {} \; 2>/dev/null || true
print_success "Permissions verified"
echo ""

###############################################################################
# Step 10: Clear OPcache (if available)
###############################################################################
echo "Step 10: Clearing OPcache..."
if command -v php &> /dev/null; then
    # Try to clear OPcache via Artisan command or restart PHP-FPM
    php artisan optimize:clear > /dev/null 2>&1 || true
    print_success "OPcache cleared"
fi
echo ""

###############################################################################
# Final Status
###############################################################################
echo "=========================================="
echo "Post-Sync Summary"
echo "=========================================="

# Show current commit
COMMIT_HASH=$(git rev-parse --short HEAD)
COMMIT_MSG=$(git log -1 --pretty=%B | head -n 1)
COMMIT_AUTHOR=$(git log -1 --pretty=%an)
COMMIT_DATE=$(git log -1 --pretty=%ar)

echo ""
echo "Current Deployment:"
echo "  Commit:  $COMMIT_HASH"
echo "  Message: $COMMIT_MSG"
echo "  Author:  $COMMIT_AUTHOR"
echo "  Date:    $COMMIT_DATE"
echo ""

# Quick health check
if php artisan about > /dev/null 2>&1; then
    print_success "Application health check passed"
else
    print_error "Warning: Application health check failed!"
fi

END_TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')
echo ""
echo "Completed at: $END_TIMESTAMP"
print_success "Post-sync completed successfully!"
echo "=========================================="
echo ""

# Log to file (optional)
LOG_FILE="storage/logs/deployments.log"
if [ -f "$LOG_FILE" ]; then
    echo "[$END_TIMESTAMP] Post-sync completed - Commit: $COMMIT_HASH" >> "$LOG_FILE"
fi
