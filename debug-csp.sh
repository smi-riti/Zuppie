#!/bin/bash

# Advanced CSP Debugging Script for Zuppie
echo "🔍 Advanced CSP Debugging for Zuppie"
echo "===================================="

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

# Get the current directory
CURRENT_DIR=$(pwd)
echo "Working directory: $CURRENT_DIR"

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo -e "${RED}Error: Not in Laravel project directory${NC}"
    exit 1
fi

echo ""
echo "📋 1. Checking middleware registration..."
echo "========================================"

if grep -q "SEOMiddleware" bootstrap/app.php; then
    echo -e "${GREEN}✓ SEOMiddleware is registered in bootstrap/app.php${NC}"
    echo "Registration details:"
    grep -A 10 -B 2 "SEOMiddleware" bootstrap/app.php
else
    echo -e "${RED}✗ SEOMiddleware NOT registered in bootstrap/app.php${NC}"
fi

echo ""
echo "📋 2. Testing local Laravel server..."
echo "===================================="

# Start Laravel server in background
echo "Starting Laravel development server..."
php artisan serve --host=127.0.0.1 --port=8000 &
SERVER_PID=$!

# Wait for server to start
sleep 3

# Test if server is running
if curl -s http://127.0.0.1:8000/test-csp > /dev/null; then
    echo -e "${GREEN}✓ Laravel server is running${NC}"
    
    echo ""
    echo "📋 3. Testing CSP headers from Laravel server..."
    echo "=============================================="
    
    # Test CSP headers
    echo "Testing headers from http://127.0.0.1:8000/test-csp"
    HEADERS=$(curl -s -I http://127.0.0.1:8000/test-csp)
    
    if echo "$HEADERS" | grep -i "content-security-policy"; then
        echo -e "${GREEN}✓ CSP headers found from Laravel:${NC}"
        echo "$HEADERS" | grep -i "content-security-policy"
    else
        echo -e "${RED}✗ No CSP headers from Laravel server${NC}"
        echo "All headers received:"
        echo "$HEADERS"
    fi
    
    echo ""
    echo "📋 4. Testing homepage..."
    echo "======================="
    
    HOME_HEADERS=$(curl -s -I http://127.0.0.1:8000/)
    if echo "$HOME_HEADERS" | grep -i "content-security-policy"; then
        echo -e "${GREEN}✓ CSP headers found on homepage:${NC}"
        echo "$HOME_HEADERS" | grep -i "content-security-policy"
    else
        echo -e "${RED}✗ No CSP headers on homepage${NC}"
    fi
    
else
    echo -e "${RED}✗ Could not start Laravel server${NC}"
fi

# Stop the server
kill $SERVER_PID 2>/dev/null

echo ""
echo "📋 5. Checking .htaccess files..."
echo "================================"

echo "Checking public/.htaccess:"
if [ -f "public/.htaccess" ]; then
    if grep -i "content-security-policy" public/.htaccess; then
        echo -e "${GREEN}✓ CSP found in public/.htaccess${NC}"
    else
        echo -e "${YELLOW}⚠ No CSP in public/.htaccess${NC}"
    fi
else
    echo -e "${RED}✗ public/.htaccess not found${NC}"
fi

echo ""
echo "Checking root .htaccess:"
if [ -f ".htaccess" ]; then
    if grep -i "content-security-policy" .htaccess; then
        echo -e "${GREEN}✓ CSP found in root .htaccess${NC}"
    else
        echo -e "${YELLOW}⚠ No CSP in root .htaccess${NC}"
    fi
else
    echo -e "${YELLOW}⚠ Root .htaccess not found${NC}"
fi

echo ""
echo "📋 6. Checking HTML meta tags..."
echo "==============================="

if grep -i "content-security-policy" resources/views/components/layouts/app.blade.php; then
    echo -e "${GREEN}✓ CSP meta tag found in layout${NC}"
else
    echo -e "${RED}✗ No CSP meta tag in layout${NC}"
fi

echo ""
echo "📋 7. Testing external resources..."
echo "=================================="

# Test external resources
RESOURCES=(
    "https://cdn.tailwindcss.com/"
    "https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
    "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    "https://unpkg.com/aos@2.3.1/dist/aos.css"
    "https://ik.imagekit.io/734vtfi5p/"
)

for resource in "${RESOURCES[@]}"; do
    echo -n "Testing $resource... "
    if curl -s --head --max-time 5 "$resource" > /dev/null 2>&1; then
        echo -e "${GREEN}✓${NC}"
    else
        echo -e "${RED}✗${NC}"
    fi
done

echo ""
echo "📋 8. Current middleware configuration..."
echo "======================================="

echo "SEOMiddleware content:"
echo "--------------------"
cat app/Http/Middleware/SEOMiddleware.php | grep -A 20 "connect-src"

echo ""
echo "📋 9. Recommendations..."
echo "======================"

echo -e "${BLUE}If you're still seeing CSP errors:${NC}"
echo ""
echo "1. Check your hosting provider's CSP settings"
echo "2. Verify that mod_headers is enabled on your server"
echo "3. Check if your hosting provider overrides CSP headers"
echo "4. Try accessing your site in incognito mode"
echo "5. Clear browser cache completely"
echo ""
echo -e "${YELLOW}For immediate testing, try:${NC}"
echo "php artisan serve"
echo "Then visit: http://127.0.0.1:8000"
echo ""
echo -e "${GREEN}The fixes are in place. If still having issues, it's likely a hosting/server configuration problem.${NC}"