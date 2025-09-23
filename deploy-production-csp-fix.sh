#!/bin/bash

# Zuppie Production Deployment Script - CSP Fix Edition
echo "🚀 Zuppie Production Deployment - CSP Fix Edition"
echo "================================================="

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo -e "${RED}Error: Not in Laravel project directory${NC}"
    exit 1
fi

echo ""
echo "🔧 Step 1: Optimization for Production"
echo "======================================"

# Clear and optimize caches
echo "Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo "Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo "📦 Step 2: Verify Self-Hosted Resources"
echo "======================================="

# Check if vendor resources exist
if [ -d "public/vendor" ]; then
    echo -e "${GREEN}✓ Self-hosted resources directory exists${NC}"
    
    if [ -f "public/vendor/css/fontawesome.min.css" ]; then
        echo -e "${GREEN}✓ Font Awesome CSS found${NC}"
    else
        echo -e "${RED}✗ Font Awesome CSS missing${NC}"
    fi
    
    if [ -f "public/vendor/css/aos.css" ]; then
        echo -e "${GREEN}✓ AOS CSS found${NC}"
    else
        echo -e "${RED}✗ AOS CSS missing${NC}"
    fi
    
    if [ -f "public/vendor/js/aos.js" ]; then
        echo -e "${GREEN}✓ AOS JS found${NC}"
    else
        echo -e "${RED}✗ AOS JS missing${NC}"
    fi
    
    if [ -f "public/vendor/js/confetti.js" ]; then
        echo -e "${GREEN}✓ Confetti JS found${NC}"
    else
        echo -e "${RED}✗ Confetti JS missing${NC}"
    fi
else
    echo -e "${YELLOW}⚠ Self-hosted resources not found. Run ./fix-csp-verification.sh first${NC}"
fi

echo ""
echo "🛡️  Step 3: CSP Configuration Options"
echo "===================================="

echo "Choose CSP configuration:"
echo "1. Full CDN support (original - may fail on some hosts)"
echo "2. Self-hosted resources only (recommended for problematic hosts)"
echo "3. Hybrid approach (self-hosted + essential CDNs)"
echo ""
read -p "Enter your choice (1-3): " csp_choice

case $csp_choice in
    1)
        echo "Using full CDN support configuration..."
        # Keep current SEOMiddleware
        ;;
    2)
        echo "Switching to self-hosted only configuration..."
        
        # Update bootstrap to use self-hosted middleware
        sed -i 's/SEOMiddleware::class/SEOMiddlewareSelfHosted::class/g' bootstrap/app.php
        
        # Update .htaccess for self-hosted
        cat > public/.htaccess << 'EOF'
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

# Security Headers for Self-Hosted Resources
<IfModule mod_headers.c>
    Header always set X-Content-Type-Options "nosniff"
    Header always set X-Frame-Options "DENY"
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
    Header always set Permissions-Policy "camera=(), microphone=(), geolocation=()"
    
    # Restrictive CSP for self-hosted resources
    Header always set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.googletagmanager.com https://www.google-analytics.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; img-src 'self' data: https: blob: https://ik.imagekit.io; font-src 'self' https://fonts.gstatic.com; connect-src 'self' https://ik.imagekit.io https://www.google-analytics.com; media-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'"
</IfModule>

# Performance Optimization
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType text/css "access plus 1 year"
    ExpiresByType application/javascript "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType font/woff "access plus 1 year"
    ExpiresByType font/woff2 "access plus 1 year"
</IfModule>

# Compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/json
</IfModule>
EOF
        
        echo -e "${GREEN}✓ Configured for self-hosted resources${NC}"
        echo ""
        echo -e "${YELLOW}Remember to update your layout file to use:${NC}"
        echo "- /vendor/css/fontawesome.min.css instead of Font Awesome CDN"
        echo "- /vendor/css/aos.css instead of AOS CDN"
        echo "- /vendor/js/aos.js instead of AOS CDN"
        echo "- /vendor/js/confetti.js instead of Confetti CDN"
        ;;
    3)
        echo "Using hybrid approach..."
        # Keep current setup but add fallbacks
        ;;
    *)
        echo "Invalid choice. Keeping current configuration."
        ;;
esac

echo ""
echo "🔍 Step 4: Final Verification"
echo "============================"

# Test CSP headers
echo "Testing CSP configuration..."
if php artisan route:list | grep -q "test-csp"; then
    echo -e "${GREEN}✓ Test route available${NC}"
else
    echo -e "${YELLOW}⚠ Test route not found${NC}"
fi

echo ""
echo "📝 Step 5: Deployment Checklist"
echo "==============================="

echo "Pre-deployment checklist:"
echo "□ Upload all files to production server"
echo "□ Update .env file with production settings"
echo "□ Run: composer install --optimize-autoloader --no-dev"
echo "□ Set proper file permissions (755 for directories, 644 for files)"
echo "□ Ensure storage/ and bootstrap/cache/ are writable"
echo "□ Test the site in production environment"
echo "□ Clear browser cache and test CSP compliance"

echo ""
echo "🎯 Step 6: Troubleshooting Commands"
echo "=================================="

echo "If CSP issues persist on production:"
echo ""
echo "1. Check server headers:"
echo "   curl -I https://your-domain.com"
echo ""
echo "2. Test specific resources:"
echo "   curl -I https://your-domain.com/vendor/css/fontawesome.min.css"
echo ""
echo "3. Check hosting provider CSP settings"
echo "   - Look for 'Security Headers' in hosting control panel"
echo "   - Disable any automatic CSP injection"
echo ""
echo "4. If all else fails, contact hosting provider about CSP override"

echo ""
echo -e "${GREEN}🎉 Deployment preparation complete!${NC}"
echo ""
echo "Next steps:"
echo "1. Upload your code to production"
echo "2. Test at: https://your-domain.com/test-csp"
echo "3. Monitor browser console for any remaining errors"
echo "4. Remove test route after verification"