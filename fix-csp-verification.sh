#!/bin/bash

# Zuppie CSP & Network Fix Verification Script
# This script helps verify the CSP fixes and optionally downloads external resources for self-hosting

echo "🎉 Zuppie - CSP & Network Fix Verification Script"
echo "=================================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to check if a command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Function to test URL accessibility
test_url() {
    local url="$1"
    local name="$2"
    
    echo -n "Testing $name... "
    
    if curl -s --head --max-time 10 "$url" > /dev/null 2>&1; then
        echo -e "${GREEN}✓ SUCCESS${NC}"
        return 0
    else
        echo -e "${RED}✗ FAILED${NC}"
        return 1
    fi
}

# Check prerequisites
echo "🔍 Checking prerequisites..."
if ! command_exists curl; then
    echo -e "${RED}Error: curl is required but not installed.${NC}"
    exit 1
fi

if ! command_exists php; then
    echo -e "${RED}Error: PHP is required but not installed.${NC}"
    exit 1
fi

echo -e "${GREEN}✓ Prerequisites check passed${NC}"
echo ""

# Test external URLs for connectivity
echo "🌐 Testing external resource connectivity..."
echo "============================================"

# CSS Resources
test_url "https://cdn.tailwindcss.com/" "Tailwind CSS CDN"
test_url "https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" "Google Fonts"
test_url "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" "Font Awesome"
test_url "https://unpkg.com/aos@2.3.1/dist/aos.css" "AOS CSS"

# JavaScript Resources
test_url "https://unpkg.com/aos@2.3.1/dist/aos.js" "AOS JavaScript"
test_url "https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js" "Canvas Confetti"

# ImageKit
test_url "https://ik.imagekit.io/734vtfi5p/" "ImageKit CDN"

echo ""

# Check Laravel configuration
echo "⚙️  Checking Laravel configuration..."
echo "===================================="

if [ -f "app/Http/Middleware/SEOMiddleware.php" ]; then
    echo -e "${GREEN}✓ SEOMiddleware found${NC}"
    
    # Check if CSP includes necessary domains
    if grep -q "cdn.tailwindcss.com" app/Http/Middleware/SEOMiddleware.php; then
        echo -e "${GREEN}✓ CSP includes Tailwind CDN${NC}"
    else
        echo -e "${RED}✗ CSP missing Tailwind CDN${NC}"
    fi
    
    if grep -q "ik.imagekit.io" app/Http/Middleware/SEOMiddleware.php; then
        echo -e "${GREEN}✓ CSP includes ImageKit CDN${NC}"
    else
        echo -e "${RED}✗ CSP missing ImageKit CDN${NC}"
    fi
else
    echo -e "${RED}✗ SEOMiddleware not found${NC}"
fi

echo ""

# Check .htaccess configuration
echo "🔧 Checking .htaccess configuration..."
echo "====================================="

if [ -f "public/.htaccess" ]; then
    echo -e "${GREEN}✓ .htaccess found${NC}"
    
    if grep -q "Content-Security-Policy" public/.htaccess; then
        echo -e "${GREEN}✓ CSP headers configured in .htaccess${NC}"
    else
        echo -e "${YELLOW}⚠ No CSP headers in .htaccess${NC}"
    fi
else
    echo -e "${RED}✗ .htaccess not found${NC}"
fi

echo ""

# Check Service Worker
echo "👷 Checking Service Worker..."
echo "============================="

if [ -f "public/sw.js" ]; then
    echo -e "${GREEN}✓ Service Worker found${NC}"
    
    # Check if POST requests are handled properly
    if grep -q "method !== 'GET'" public/sw.js; then
        echo -e "${GREEN}✓ Service Worker filters non-GET requests${NC}"
    else
        echo -e "${YELLOW}⚠ Service Worker may cache all request methods${NC}"
    fi
    
    # Check cache version
    cache_version=$(grep "CACHE_NAME = " public/sw.js | head -1)
    echo -e "${BLUE}ℹ Cache version: $cache_version${NC}"
else
    echo -e "${RED}✗ Service Worker not found${NC}"
fi

echo ""

# Function to download external resources for self-hosting
download_resources() {
    echo "📥 Downloading external resources for self-hosting..."
    echo "===================================================="
    
    mkdir -p public/vendor/css
    mkdir -p public/vendor/js
    mkdir -p public/vendor/fonts
    
    echo "Downloading CSS resources..."
    
    # Download Font Awesome
    echo -n "Downloading Font Awesome... "
    if curl -s -o public/vendor/css/fontawesome.min.css "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"; then
        echo -e "${GREEN}✓${NC}"
    else
        echo -e "${RED}✗${NC}"
    fi
    
    # Download AOS CSS
    echo -n "Downloading AOS CSS... "
    if curl -s -o public/vendor/css/aos.css "https://unpkg.com/aos@2.3.1/dist/aos.css"; then
        echo -e "${GREEN}✓${NC}"
    else
        echo -e "${RED}✗${NC}"
    fi
    
    echo "Downloading JavaScript resources..."
    
    # Download AOS JS
    echo -n "Downloading AOS JS... "
    if curl -s -o public/vendor/js/aos.js "https://unpkg.com/aos@2.3.1/dist/aos.js"; then
        echo -e "${GREEN}✓${NC}"
    else
        echo -e "${RED}✗${NC}"
    fi
    
    # Download Canvas Confetti
    echo -n "Downloading Canvas Confetti... "
    if curl -s -o public/vendor/js/confetti.js "https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"; then
        echo -e "${GREEN}✓${NC}"
    else
        echo -e "${RED}✗${NC}"
    fi
    
    echo ""
    echo -e "${GREEN}✓ Resource download complete!${NC}"
    echo ""
    echo "To use self-hosted resources, update your layout file:"
    echo "- Replace CDN links with /vendor/css/ and /vendor/js/ links"
    echo "- Update your CSP policy to remove external CDN domains"
    echo ""
}

# Clear Laravel caches
clear_caches() {
    echo "🧹 Clearing Laravel caches..."
    echo "============================"
    
    if command_exists php && [ -f "artisan" ]; then
        php artisan config:clear
        php artisan route:clear
        php artisan view:clear
        php artisan cache:clear
        echo -e "${GREEN}✓ Laravel caches cleared${NC}"
    else
        echo -e "${YELLOW}⚠ Could not clear Laravel caches (artisan not found)${NC}"
    fi
    echo ""
}

# Generate updated CSP policy
generate_csp() {
    echo "🛡️  Recommended CSP Policy:"
    echo "=========================="
    echo ""
    cat << 'EOF'
For .htaccess:
Header always set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com https://cdn.jsdelivr.net https://unpkg.com https://www.googletagmanager.com https://www.google-analytics.com; style-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://fonts.googleapis.com https://cdnjs.cloudflare.com https://unpkg.com; img-src 'self' data: https: blob: https://ik.imagekit.io; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; connect-src 'self' https://cdn.tailwindcss.com https://fonts.googleapis.com https://fonts.gstatic.com https://cdnjs.cloudflare.com https://unpkg.com https://ik.imagekit.io https://cdn.jsdelivr.net https://www.google-analytics.com; media-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'"

For Laravel Middleware:
"default-src 'self'",
"script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com https://cdn.jsdelivr.net https://unpkg.com https://www.googletagmanager.com https://www.google-analytics.com",
"style-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://fonts.googleapis.com https://cdnjs.cloudflare.com https://unpkg.com",
"img-src 'self' data: https: blob: https://ik.imagekit.io",
"font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com",
"connect-src 'self' https://cdn.tailwindcss.com https://fonts.googleapis.com https://fonts.gstatic.com https://cdnjs.cloudflare.com https://unpkg.com https://ik.imagekit.io https://cdn.jsdelivr.net https://www.google-analytics.com",
"media-src 'self'",
"object-src 'none'",
"base-uri 'self'",
"form-action 'self'",
"frame-ancestors 'none'"
EOF
    echo ""
}

# Main menu
echo "What would you like to do?"
echo "1. Test current configuration"
echo "2. Download external resources for self-hosting"
echo "3. Clear Laravel caches"
echo "4. Show recommended CSP policy"
echo "5. Run all checks and recommendations"
echo ""
read -p "Enter your choice (1-5): " choice

case $choice in
    1)
        echo "Running tests only..."
        ;;
    2)
        download_resources
        ;;
    3)
        clear_caches
        ;;
    4)
        generate_csp
        ;;
    5)
        clear_caches
        generate_csp
        echo ""
        read -p "Do you want to download external resources for self-hosting? (y/n): " download_choice
        if [[ $download_choice =~ ^[Yy]$ ]]; then
            download_resources
        fi
        ;;
    *)
        echo "Invalid choice. Running basic tests..."
        ;;
esac

echo ""
echo "🏁 Script completed!"
echo ""
echo "Next steps:"
echo "1. Open test-csp-fixes.html in your browser to test the fixes"
echo "2. Check the browser console for any remaining CSP violations"
echo "3. Clear your browser cache and hard refresh (Ctrl+F5)"
echo "4. Restart your web server if needed"
echo ""
echo "If you're still experiencing issues:"
echo "- Check your hosting provider's CSP settings"
echo "- Verify that your .htaccess file is being processed"
echo "- Consider using self-hosted resources instead of CDNs"