#!/bin/bash

###############################################################################
# Histone Solutions Website - Production Deployment Script
###############################################################################
# This script handles complete deployment of the Laravel application
# Usage: ./deploy.sh
###############################################################################

set -e  # Exit on any error

echo "=========================================="
echo "Histone Solutions - Deployment Starting"
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

# Check if we're in the correct directory
if [ ! -f "artisan" ]; then
    print_error "Error: artisan file not found. Are you in the Laravel project root?"
    exit 1
fi

print_success "Starting deployment process..."
echo ""

###############################################################################
# Step 1: Put application in maintenance mode
###############################################################################
echo "Step 1: Enabling maintenance mode..."
php artisan down --render="errors::503" --retry=60 || true
print_success "Maintenance mode enabled"
echo ""

###############################################################################
# Step 2: Pull latest code from Git
###############################################################################
echo "Step 2: Pulling latest code from repository..."
git fetch origin
CURRENT_BRANCH=$(git rev-parse --abbrev-ref HEAD)
print_warning "Current branch: $CURRENT_BRANCH"

read -p "Pull latest changes from $CURRENT_BRANCH? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    git pull origin $CURRENT_BRANCH
    print_success "Code updated from Git"
else
    print_warning "Skipped Git pull"
fi
echo ""

###############################################################################
# Step 3: Install/Update Composer dependencies
###############################################################################
echo "Step 3: Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction
print_success "Composer dependencies installed"
echo ""

###############################################################################
# Step 4: Install/Update NPM dependencies (if needed)
###############################################################################
echo "Step 4: Checking for NPM dependencies..."
if [ -f "package.json" ]; then
    print_warning "Found package.json - installing NPM dependencies..."
    npm ci --only=production
    print_success "NPM dependencies installed"
else
    print_warning "No package.json found, skipping NPM install"
fi
echo ""

###############################################################################
# Step 5: Clear and optimize caches
###############################################################################
echo "Step 5: Clearing and optimizing caches..."

# Clear various caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
print_success "Caches cleared"

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
print_success "Application optimized"
echo ""

###############################################################################
# Step 6: Run database migrations
###############################################################################
echo "Step 6: Running database migrations..."
read -p "Run database migrations? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan migrate --force
    print_success "Database migrations completed"
else
    print_warning "Skipped database migrations"
fi
echo ""

###############################################################################
# Step 7: Seed blog author
###############################################################################
echo "Step 7: Creating/updating blog author..."
php artisan db:seed --class=BlogAuthorSeeder --force
print_success "Blog author seeded"
echo ""

###############################################################################
# Step 8: Generate sitemap
###############################################################################
echo "Step 8: Generating sitemap..."
php artisan sitemap:generate
print_success "Sitemap generated"
echo ""

###############################################################################
# Step 9: Fix file permissions
###############################################################################
echo "Step 9: Setting proper file permissions..."

# Set ownership (adjust user/group as needed)
# Uncomment and modify if you need to change ownership
# sudo chown -R www-data:www-data .

# Set directory permissions
find storage bootstrap/cache -type d -exec chmod 775 {} \;
find storage bootstrap/cache -type f -exec chmod 664 {} \;

print_success "File permissions set"
echo ""

###############################################################################
# Step 10: Restart services (if needed)
###############################################################################
echo "Step 10: Restarting services..."

# Restart PHP-FPM (adjust service name as needed)
if command -v systemctl &> /dev/null; then
    read -p "Restart PHP-FPM service? (y/n): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        sudo systemctl restart php-fpm || sudo systemctl restart php8.2-fpm || true
        print_success "PHP-FPM restarted"
    fi
fi

# Restart queue workers if using
if pgrep -f "artisan queue:work" > /dev/null; then
    print_warning "Restarting queue workers..."
    php artisan queue:restart
    print_success "Queue workers restarted"
fi

echo ""

###############################################################################
# Step 11: Disable maintenance mode
###############################################################################
echo "Step 11: Disabling maintenance mode..."
php artisan up
print_success "Application is now live!"
echo ""

###############################################################################
# Final Health Check
###############################################################################
echo "=========================================="
echo "Deployment Health Check"
echo "=========================================="

# Check if application is responding
if php artisan about > /dev/null 2>&1; then
    print_success "Application is responding"
else
    print_error "Warning: Application may not be responding correctly"
fi

# Show current version/commit
COMMIT_HASH=$(git rev-parse --short HEAD)
COMMIT_MSG=$(git log -1 --pretty=%B)
echo ""
echo "Current Version:"
echo "  Commit: $COMMIT_HASH"
echo "  Message: $COMMIT_MSG"
echo ""

print_success "Deployment completed successfully!"
echo "=========================================="
echo ""
