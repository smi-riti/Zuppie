#!/bin/bash

# Zuppie.in Production SEO Audit Script
# Enhanced version for production environment

echo "🚀 Starting Zuppie.in Production SEO Audit..."
echo "=========================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
NC='\033[0m' # No Color

# Configuration
DOMAIN="zuppie.in"
BASE_URL="https://$DOMAIN"
SCORE=0
TOTAL_CHECKS=0

# Function to check URL and return status
check_url() {
    local url=$1
    local expected_code=${2:-200}
    
    status_code=$(curl -o /dev/null -s -w "%{http_code}" "$url" --max-time 10 --connect-timeout 5)
    
    if [ "$status_code" -eq "$expected_code" ]; then
        echo -e "${GREEN}✓${NC} $url (Status: $status_code)"
        ((SCORE++))
    else
        echo -e "${RED}✗${NC} $url (Status: $status_code, Expected: $expected_code)"
    fi
    ((TOTAL_CHECKS++))
}

# Function to check if content contains specific text
check_content() {
    local url=$1
    local search_text=$2
    local description=$3
    
    content=$(curl -s "$url" --max-time 10 --connect-timeout 5)
    
    if echo "$content" | grep -q "$search_text"; then
        echo -e "${GREEN}✓${NC} $description"
        ((SCORE++))
    else
        echo -e "${RED}✗${NC} $description"
    fi
    ((TOTAL_CHECKS++))
}

# Function to check header
check_header() {
    local url=$1
    local header=$2
    local description=$3
    
    header_value=$(curl -s -I "$url" --max-time 10 --connect-timeout 5 | grep -i "$header" | head -1)
    
    if [ -n "$header_value" ]; then
        echo -e "${GREEN}✓${NC} $description: $header_value"
        ((SCORE++))
    else
        echo -e "${RED}✗${NC} $description missing"
    fi
    ((TOTAL_CHECKS++))
}

# Function to check response time
check_response_time() {
    local url=$1
    local max_time=${2:-2}
    
    response_time=$(curl -o /dev/null -s -w "%{time_total}" "$url" --max-time 10 --connect-timeout 5)
    
    if (( $(echo "$response_time < $max_time" | bc -l) )); then
        echo -e "${GREEN}✓${NC} Response time: ${response_time}s (Good)"
        ((SCORE++))
    else
        echo -e "${YELLOW}⚠${NC} Response time: ${response_time}s (Could be better)"
    fi
    ((TOTAL_CHECKS++))
}

# Function to check SSL certificate
check_ssl() {
    local domain=$1
    
    ssl_info=$(echo | openssl s_client -servername "$domain" -connect "$domain:443" -brief 2>/dev/null | head -1)
    
    if echo "$ssl_info" | grep -q "CONNECTED"; then
        echo -e "${GREEN}✓${NC} SSL Certificate is valid"
        ((SCORE++))
    else
        echo -e "${RED}✗${NC} SSL Certificate issue"
    fi
    ((TOTAL_CHECKS++))
}

# Function to check DNS records
check_dns() {
    local domain=$1
    
    # Check A record
    a_record=$(dig +short "$domain" A)
    if [ -n "$a_record" ]; then
        echo -e "${GREEN}✓${NC} A Record: $a_record"
        ((SCORE++))
    else
        echo -e "${RED}✗${NC} A Record missing"
    fi
    ((TOTAL_CHECKS++))
    
    # Check AAAA record (IPv6)
    aaaa_record=$(dig +short "$domain" AAAA)
    if [ -n "$aaaa_record" ]; then
        echo -e "${GREEN}✓${NC} AAAA Record: $aaaa_record"
        ((SCORE++))
    else
        echo -e "${YELLOW}⚠${NC} AAAA Record missing (IPv6 support)"
    fi
    ((TOTAL_CHECKS++))
    
    # Check MX record
    mx_record=$(dig +short "$domain" MX)
    if [ -n "$mx_record" ]; then
        echo -e "${GREEN}✓${NC} MX Record: $mx_record"
        ((SCORE++))
    else
        echo -e "${YELLOW}⚠${NC} MX Record missing"
    fi
    ((TOTAL_CHECKS++))
}

# Function to check page speed insights
check_page_speed() {
    local url=$1
    local api_key=${2:-""}
    
    if [ -n "$api_key" ]; then
        echo -e "${BLUE}🔍${NC} Checking PageSpeed Insights..."
        
        # Mobile score
        mobile_result=$(curl -s "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=$url&strategy=mobile&key=$api_key" | jq '.lighthouseResult.categories.performance.score')
        
        if [ "$mobile_result" != "null" ]; then
            mobile_score=$(echo "$mobile_result * 100" | bc | cut -d. -f1)
            echo -e "${GREEN}✓${NC} Mobile PageSpeed Score: $mobile_score/100"
            if [ "$mobile_score" -gt 80 ]; then
                ((SCORE++))
            fi
        else
            echo -e "${YELLOW}⚠${NC} Unable to fetch mobile PageSpeed score"
        fi
        
        # Desktop score
        desktop_result=$(curl -s "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=$url&strategy=desktop&key=$api_key" | jq '.lighthouseResult.categories.performance.score')
        
        if [ "$desktop_result" != "null" ]; then
            desktop_score=$(echo "$desktop_result * 100" | bc | cut -d. -f1)
            echo -e "${GREEN}✓${NC} Desktop PageSpeed Score: $desktop_score/100"
            if [ "$desktop_score" -gt 90 ]; then
                ((SCORE++))
            fi
        else
            echo -e "${YELLOW}⚠${NC} Unable to fetch desktop PageSpeed score"
        fi
        
        ((TOTAL_CHECKS += 2))
    else
        echo -e "${YELLOW}⚠${NC} PageSpeed API key not provided, skipping detailed analysis"
    fi
}

echo ""
echo -e "${BLUE}🌐${NC} Testing Basic Website Functionality..."
echo "============================================"

# Basic connectivity tests
check_url "$BASE_URL" 200
check_url "$BASE_URL/robots.txt" 200
check_url "$BASE_URL/sitemap.xml" 200
check_url "$BASE_URL/sitemap/static.xml" 200
check_url "$BASE_URL/sitemap/categories.xml" 200
check_url "$BASE_URL/sitemap/packages.xml" 200
check_url "$BASE_URL/sitemap/offers.xml" 200
check_url "$BASE_URL/sitemap/blogs.xml" 200
check_url "$BASE_URL/manifest.json" 200
check_url "$BASE_URL/sw.js" 200
check_url "$BASE_URL/offline.html" 200
check_url "$BASE_URL/404.html" 404

echo ""
echo -e "${BLUE}🔒${NC} Testing Security & SSL..."
echo "============================"

# SSL and security checks
check_ssl "$DOMAIN"
check_header "$BASE_URL" "Strict-Transport-Security" "HSTS Header"
check_header "$BASE_URL" "X-Content-Type-Options" "X-Content-Type-Options"
check_header "$BASE_URL" "X-Frame-Options" "X-Frame-Options"
check_header "$BASE_URL" "X-XSS-Protection" "X-XSS-Protection"
check_header "$BASE_URL" "Content-Security-Policy" "Content Security Policy"

echo ""
echo -e "${BLUE}📋${NC} Testing SEO Meta Tags..."
echo "============================"

# Meta tags validation
check_content "$BASE_URL" "google-site-verification" "Google Site Verification"
check_content "$BASE_URL" '<meta name="description"' "Meta Description"
check_content "$BASE_URL" '<meta name="keywords"' "Meta Keywords"
check_content "$BASE_URL" '<meta name="author"' "Meta Author"
check_content "$BASE_URL" '<meta name="robots"' "Meta Robots"
check_content "$BASE_URL" '<link rel="canonical"' "Canonical URL"
check_content "$BASE_URL" 'property="og:title"' "Open Graph Title"
check_content "$BASE_URL" 'property="og:description"' "Open Graph Description"
check_content "$BASE_URL" 'property="og:image"' "Open Graph Image"
check_content "$BASE_URL" 'property="og:url"' "Open Graph URL"
check_content "$BASE_URL" 'name="twitter:card"' "Twitter Card"
check_content "$BASE_URL" 'name="twitter:title"' "Twitter Title"
check_content "$BASE_URL" 'name="twitter:description"' "Twitter Description"
check_content "$BASE_URL" 'name="twitter:image"' "Twitter Image"

echo ""
echo -e "${BLUE}🏗️${NC} Testing Structured Data..."
echo "============================"

# Structured data validation
check_content "$BASE_URL" '"@type":"Organization"' "Organization Schema"
check_content "$BASE_URL" '"@type":"LocalBusiness"' "Local Business Schema"
check_content "$BASE_URL" '"@type":"WebSite"' "Website Schema"
check_content "$BASE_URL" '"address"' "Address Information"
check_content "$BASE_URL" '"geo"' "Geographic Information"
check_content "$BASE_URL" '"telephone"' "Phone Number"
check_content "$BASE_URL" '"email"' "Email Address"

echo ""
echo -e "${BLUE}📱${NC} Testing Mobile & PWA Features..."
echo "============================"

# Mobile and PWA checks
check_content "$BASE_URL" 'name="viewport"' "Viewport Meta Tag"
check_content "$BASE_URL" 'name="mobile-web-app-capable"' "Mobile Web App Capable"
check_content "$BASE_URL" 'name="apple-mobile-web-app-capable"' "Apple Mobile Web App Capable"
check_content "$BASE_URL" 'name="theme-color"' "Theme Color"
check_content "$BASE_URL" 'rel="manifest"' "Web App Manifest"
check_content "$BASE_URL/manifest.json" '"start_url"' "PWA Start URL"
check_content "$BASE_URL/manifest.json" '"display"' "PWA Display Mode"
check_content "$BASE_URL/manifest.json" '"theme_color"' "PWA Theme Color"

echo ""
echo -e "${BLUE}⚡${NC} Testing Performance..."
echo "============================"

# Performance checks
check_response_time "$BASE_URL" 2
check_header "$BASE_URL" "Content-Encoding" "GZIP Compression"
check_header "$BASE_URL" "Cache-Control" "Cache Control"
check_header "$BASE_URL" "Expires" "Expires Header"

echo ""
echo -e "${BLUE}🌐${NC} Testing DNS Configuration..."
echo "============================"

# DNS checks
check_dns "$DOMAIN"

echo ""
echo -e "${BLUE}📊${NC} Testing Page Speed (if API key available)..."
echo "============================"

# PageSpeed Insights (requires API key)
GOOGLE_API_KEY=${GOOGLE_PAGESPEED_API_KEY:-""}
if [ -n "$GOOGLE_API_KEY" ]; then
    check_page_speed "$BASE_URL" "$GOOGLE_API_KEY"
else
    echo -e "${YELLOW}⚠${NC} Google PageSpeed API key not set. Export GOOGLE_PAGESPEED_API_KEY to enable detailed analysis."
fi

echo ""
echo -e "${BLUE}🔍${NC} Testing Local SEO..."
echo "============================"

# Local SEO checks
check_content "$BASE_URL" "Purnia" "Location Targeting (Purnia)"
check_content "$BASE_URL" "Bihar" "State Targeting (Bihar)"
check_content "$BASE_URL" "25.77" "Latitude Coordinates"
check_content "$BASE_URL" "87.47" "Longitude Coordinates"
check_content "$BASE_URL" "854301" "PIN Code"
check_content "$BASE_URL" "event management" "Service Keywords"

echo ""
echo -e "${PURPLE}📈${NC} SEO Score Summary"
echo "=================================="

# Calculate percentage
percentage=$((SCORE * 100 / TOTAL_CHECKS))

echo -e "${GREEN}✅${NC} Passed Checks: $SCORE/$TOTAL_CHECKS"
echo -e "${BLUE}🎯${NC} SEO Score: $percentage%"

if [ $percentage -ge 90 ]; then
    echo -e "${GREEN}🏆${NC} Excellent! Your website has outstanding SEO."
elif [ $percentage -ge 80 ]; then
    echo -e "${YELLOW}⭐${NC} Good! Your website has solid SEO with room for improvement."
elif [ $percentage -ge 70 ]; then
    echo -e "${YELLOW}⚠${NC} Fair! Your website needs SEO improvements."
else
    echo -e "${RED}❌${NC} Poor! Your website requires significant SEO work."
fi

echo ""
echo -e "${PURPLE}🚀${NC} Production SEO Recommendations"
echo "=================================="

echo "1. Monitor Core Web Vitals regularly"
echo "2. Set up Google Analytics and Search Console"
echo "3. Create Google My Business listing for local SEO"
echo "4. Generate quality backlinks from local directories"
echo "5. Create location-specific content for Purnia market"
echo "6. Optimize images with WebP format"
echo "7. Implement AMP for mobile pages"
echo "8. Set up structured data monitoring"
echo "9. Create XML sitemaps for different content types"
echo "10. Regular SEO audits and competitor analysis"

echo ""
echo -e "${BLUE}📅${NC} Expected Timeline for SEO Results"
echo "=================================="

echo "• Week 1-2: Technical SEO improvements reflected"
echo "• Week 3-4: Search engine discovery and crawling"
echo "• Month 1-2: Local search visibility improvements"
echo "• Month 2-3: Keyword ranking improvements"
echo "• Month 3-6: Significant organic traffic growth"
echo "• Month 6+: Established market presence in Purnia"

echo ""
echo -e "${GREEN}✅${NC} Production SEO Audit Complete!"
echo "Visit https://zuppie.in to see your optimized website."

# Generate timestamp for reporting
echo ""
echo "Audit completed at: $(date)"
echo "Report generated for: $DOMAIN"
echo "Total checks performed: $TOTAL_CHECKS"
echo "SEO Score: $percentage%"
