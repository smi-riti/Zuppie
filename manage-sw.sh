#!/bin/bash

echo "Service Worker Management Script for Zuppie"
echo "=========================================="
echo ""
echo "This script helps manage service worker issues during development"
echo ""
echo "Choose an option:"
echo "1. Backup current sw.js"
echo "2. Disable service worker (for testing)"
echo "3. Enable service worker (restore)"
echo "4. Show current status"
echo ""
read -p "Enter your choice (1-4): " choice

case $choice in
    1)
        cp public/sw.js public/sw.js.backup
        echo "✅ Service worker backed up to sw.js.backup"
        ;;
    2)
        if [ -f "public/sw.js" ]; then
            mv public/sw.js public/sw.js.disabled
            echo "// Service worker temporarily disabled for testing" > public/sw.js
            echo "✅ Service worker disabled"
            echo "💡 Run Lighthouse now without SW interference"
        else
            echo "❌ sw.js not found"
        fi
        ;;
    3)
        if [ -f "public/sw.js.disabled" ]; then
            mv public/sw.js.disabled public/sw.js
            echo "✅ Service worker enabled"
        elif [ -f "public/sw.js.backup" ]; then
            cp public/sw.js.backup public/sw.js
            echo "✅ Service worker restored from backup"
        else
            echo "❌ No disabled or backup service worker found"
        fi
        ;;
    4)
        echo "Current status:"
        if [ -f "public/sw.js" ] && [ -s "public/sw.js" ]; then
            lines=$(wc -l < public/sw.js)
            if [ $lines -gt 5 ]; then
                echo "✅ Service worker is active ($lines lines)"
            else
                echo "⚠️  Service worker is disabled (placeholder file)"
            fi
        else
            echo "❌ No service worker found"
        fi
        
        if [ -f "public/sw.js.backup" ]; then
            echo "📁 Backup file exists"
        fi
        
        if [ -f "public/sw.js.disabled" ]; then
            echo "📁 Disabled file exists"
        fi
        ;;
    *)
        echo "❌ Invalid choice"
        ;;
esac