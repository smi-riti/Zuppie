# 🚀 Laravel 12 + Livewire Production Deployment Guide

This guide resolves **cache issues with CSS and CDN assets** when deploying Laravel 12 with Livewire to production (cPanel/shared hosting).

## 🔍 Root Cause Analysis

The cache issues were caused by:
1. **Tailwind CDN** instead of compiled Vite assets
2. **Missing asset URL configuration** for production
3. **Livewire asset loading** inconsistencies between local/production
4. **Cache headers** not optimized for static assets
5. **Environment configuration** missing production-specific settings

## ✅ Fixed Issues

- ✅ Replaced Tailwind CDN with proper Vite compilation
- ✅ Added production asset URL handling
- ✅ Configured Livewire for production asset loading
- ✅ Added cache control headers for optimal performance
- ✅ Created automated deployment scripts
- ✅ Added production environment templates

## 📦 What Was Changed

### 1. Environment Configuration
- **`.env.example`** - Added production asset URL variables
- **`.env.production`** - Complete production environment template

### 2. Asset Compilation
- **`vite.config.js`** - Optimized for production builds with proper base URLs
- **`resources/views/components/layouts/app.blade.php`** - Replaced CDN with `@vite` directive

### 3. Livewire Configuration
- **`config/livewire.php`** - Added asset URL configuration for production

### 4. Deployment Tools
- **`deploy.php`** - Automated PHP deployment script
- **`deploy.sh`** - Bash deployment script for cPanel
- **`.htaccess-production`** - Production-optimized Apache configuration

## 🚀 Deployment Instructions

### Local Development Setup
1. Copy environment configuration:
   ```bash
   cp .env.example .env
   ```

2. Install dependencies and build assets:
   ```bash
   composer install
   npm install
   npm run build
   ```

### Production Deployment (cPanel)

#### Method 1: Using PHP Deployment Script
1. Upload all files to your cPanel public_html directory
2. Update your `.env` file with production values:
   ```bash
   cp .env.production .env
   # Edit .env with your domain and database details
   ```
3. Run the deployment script:
   ```bash
   php deploy.php
   ```

#### Method 2: Using Bash Script (if available)
1. Upload files and make script executable:
   ```bash
   chmod +x deploy.sh
   ./deploy.sh
   ```

#### Method 3: Manual Deployment
1. **Upload files** to your cPanel file manager
2. **Configure environment**:
   ```bash
   # Create .env from template
   cp .env.production .env
   
   # Update these critical values in .env:
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   ASSET_URL=https://yourdomain.com
   VITE_APP_URL=https://yourdomain.com
   LIVEWIRE_ASSET_URL=https://yourdomain.com
   ```

3. **Install dependencies** (if Composer is available):
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

4. **Build assets locally** and upload:
   ```bash
   npm run build
   # Upload the entire /public/build directory to your server
   ```

5. **Clear and optimize caches**:
   ```bash
   php artisan config:clear
   php artisan route:clear  
   php artisan view:clear
   php artisan cache:clear
   php artisan event:clear
   
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan optimize
   ```

6. **Set permissions**:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

7. **Configure web server**:
   - Copy `.htaccess-production` to `public/.htaccess`
   - Point your domain to the `/public` directory

## 🔧 Critical Production Settings

### Environment Variables (.env)
```bash
# CRITICAL: These must match your production domain
APP_URL=https://yourdomain.com
ASSET_URL=https://yourdomain.com
VITE_APP_URL=https://yourdomain.com
LIVEWIRE_ASSET_URL=https://yourdomain.com

# Production settings
APP_ENV=production
APP_DEBUG=false
APP_FORCE_HTTPS=true

# Cache optimization
CACHE_STORE=file
SESSION_DRIVER=file
```

### Web Server Configuration
Ensure your cPanel points to the `/public` directory, not the root folder.

## 🔄 Solving Common Cache Issues

### Issue: CSS/JS not loading after deployment
**Solution:**
```bash
# 1. Clear all caches
php artisan optimize:clear

# 2. Rebuild caches
php artisan optimize

# 3. Check asset URLs in browser network tab
# They should point to your domain, not localhost
```

### Issue: Livewire components not working
**Solution:**
```bash
# 1. Verify APP_URL in .env matches your domain exactly
# 2. Clear browser cache completely
# 3. Check if Livewire assets are loading:
#    https://yourdomain.com/livewire/livewire.js
```

### Issue: Mixed content errors (HTTP/HTTPS)
**Solution:**
```bash
# In .env file:
APP_URL=https://yourdomain.com  # Use HTTPS
APP_FORCE_HTTPS=true
```

## 📋 Deployment Checklist

- [ ] **Environment**: `.env` file configured with production values
- [ ] **Assets**: `npm run build` completed and `/public/build` uploaded
- [ ] **Dependencies**: `composer install --no-dev` completed
- [ ] **Caches**: All Laravel caches cleared and rebuilt
- [ ] **Permissions**: `storage` and `bootstrap/cache` are writable (775)
- [ ] **Web Server**: Domain points to `/public` directory
- [ ] **HTTPS**: SSL certificate configured and `APP_FORCE_HTTPS=true`
- [ ] **Database**: Connection working and migrations run
- [ ] **Testing**: All pages load correctly without cache issues

## 🐛 Troubleshooting

### Assets still loading from localhost
- Check `APP_URL` and `ASSET_URL` in `.env`
- Clear all caches: `php artisan optimize:clear`
- Check browser network tab

### Livewire not working
- Verify Livewire assets load: `/livewire/livewire.js`
- Check `LIVEWIRE_ASSET_URL` setting
- Clear browser cache

### Performance issues
- Enable caching: `php artisan optimize`
- Verify `.htaccess` cache headers are active
- Use browser developer tools to check cache headers

## 📞 Support

If issues persist after following this guide:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check browser console for JavaScript errors
3. Verify all asset URLs resolve correctly
4. Ensure cPanel PHP version matches your local development version

---

**🎉 Your Laravel application should now deploy without cache issues!**