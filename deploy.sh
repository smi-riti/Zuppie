#!/bin/bash

# Production Deployment Script for cPanel/Shared Hosting
# Run this script after uploading your files to deploy properly

echo "🚀 Starting Laravel Production Deployment..."

# Set proper permissions
echo "🔐 Setting file permissions..."
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod -R 775 storage bootstrap/cache
chmod 644 .env 2>/dev/null || echo "⚠️  .env file not found"

# Install/update dependencies (if composer is available)
if command -v composer &> /dev/null; then
    echo "📦 Installing/updating Composer dependencies..."
    composer install --optimize-autoloader --no-dev
else
    echo "⚠️  Composer not found, skipping dependency install"
fi

# Install/build assets (if npm is available)
if command -v npm &> /dev/null; then
    echo "🎨 Building production assets..."
    npm ci --omit=dev
    npm run build
else
    echo "⚠️  NPM not found, make sure to upload pre-built assets"
fi

# Clear all caches
echo "🧹 Clearing application caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan event:clear

# Optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan optimize

# Generate application key if not present
if ! grep -q "APP_KEY=" .env 2>/dev/null || grep -q "APP_KEY=$" .env 2>/dev/null; then
    echo "🔑 Generating application key..."
    php artisan key:generate
fi

# Copy production htaccess if exists
if [ -f ".htaccess-production" ]; then
    echo "📄 Installing production .htaccess..."
    cp .htaccess-production public/.htaccess
fi

# Create storage link if it doesn't exist
if [ ! -L "public/storage" ]; then
    echo "🔗 Creating storage symlink..."
    php artisan storage:link
fi

# Final checks
echo ""
echo "✅ Deployment completed!"
echo ""
echo "📋 IMPORTANT: Verify these settings in your .env file:"
echo "   - APP_ENV=production"
echo "   - APP_DEBUG=false"
echo "   - APP_URL=https://yourdomain.com"
echo "   - Database credentials are correct"
echo ""
echo "🌐 Make sure your web server points to the /public directory"
echo "🔒 Ensure HTTPS is properly configured"
echo ""
echo "🎉 Your Laravel application should now be ready for production!"