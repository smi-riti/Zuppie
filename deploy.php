<?php

/**
 * Production Deployment Script for Laravel with Livewire
 * 
 * This script handles proper cache clearing, optimization, and asset management
 * for production deployments on cPanel or shared hosting.
 * 
 * Usage: php deploy.php
 */

require_once 'vendor/autoload.php';

class DeploymentManager
{
    private array $commands = [];
    private string $baseDir;
    
    public function __construct()
    {
        $this->baseDir = __DIR__;
        echo "🚀 Starting Laravel Production Deployment...\n\n";
    }
    
    public function run(): void
    {
        $this->clearAllCaches();
        $this->optimizeForProduction();
        $this->verifyAssets();
        $this->setPermissions();
        $this->displaySummary();
    }
    
    private function clearAllCaches(): void
    {
        echo "🧹 Clearing all caches...\n";
        
        $cacheCommands = [
            'php artisan config:clear',
            'php artisan route:clear', 
            'php artisan view:clear',
            'php artisan cache:clear',
            'php artisan event:clear',
            'php artisan queue:clear',
        ];
        
        foreach ($cacheCommands as $command) {
            $this->executeCommand($command);
        }
        
        // Clear compiled files
        $compiledFiles = [
            'bootstrap/cache/config.php',
            'bootstrap/cache/routes-v7.php',
            'bootstrap/cache/services.php',
            'bootstrap/cache/packages.php'
        ];
        
        foreach ($compiledFiles as $file) {
            if (file_exists($this->baseDir . '/' . $file)) {
                unlink($this->baseDir . '/' . $file);
                echo "   ✓ Removed: {$file}\n";
            }
        }
        
        echo "\n";
    }
    
    private function optimizeForProduction(): void
    {
        echo "⚡ Optimizing for production...\n";
        
        $optimizeCommands = [
            'php artisan config:cache',
            'php artisan route:cache',
            'php artisan view:cache',
            'php artisan event:cache',
            'php artisan optimize',
        ];
        
        foreach ($optimizeCommands as $command) {
            $this->executeCommand($command);
        }
        
        echo "\n";
    }
    
    private function verifyAssets(): void
    {
        echo "📦 Verifying assets...\n";
        
        $buildDir = $this->baseDir . '/public/build';
        $manifestFile = $buildDir . '/manifest.json';
        
        if (!is_dir($buildDir)) {
            echo "   ⚠️  Build directory not found. Run 'npm run build' first.\n";
            return;
        }
        
        if (!file_exists($manifestFile)) {
            echo "   ⚠️  Manifest file not found. Assets may not load properly.\n";
            return;
        }
        
        $manifest = json_decode(file_get_contents($manifestFile), true);
        
        echo "   ✓ Build directory exists\n";
        echo "   ✓ Manifest file found\n";
        echo "   ✓ Assets: " . count($manifest) . " files\n";
        
        echo "\n";
    }
    
    private function setPermissions(): void
    {
        echo "🔐 Setting permissions...\n";
        
        $directories = [
            'storage',
            'storage/app',
            'storage/framework',
            'storage/framework/cache',
            'storage/framework/sessions',
            'storage/framework/views',
            'storage/logs',
            'bootstrap/cache',
        ];
        
        foreach ($directories as $dir) {
            $fullPath = $this->baseDir . '/' . $dir;
            if (is_dir($fullPath)) {
                chmod($fullPath, 0775);
                echo "   ✓ Set permissions for: {$dir}\n";
            }
        }
        
        echo "\n";
    }
    
    private function executeCommand(string $command): void
    {
        echo "   Running: {$command}\n";
        $output = [];
        $returnCode = 0;
        
        exec($command . ' 2>&1', $output, $returnCode);
        
        if ($returnCode !== 0) {
            echo "   ❌ Failed: " . implode("\n", $output) . "\n";
        } else {
            echo "   ✓ Success\n";
        }
        
        $this->commands[] = [
            'command' => $command,
            'success' => $returnCode === 0,
            'output' => $output
        ];
    }
    
    private function displaySummary(): void
    {
        echo "\n" . str_repeat('=', 50) . "\n";
        echo "📋 DEPLOYMENT SUMMARY\n";
        echo str_repeat('=', 50) . "\n\n";
        
        $successful = array_filter($this->commands, fn($cmd) => $cmd['success']);
        $failed = array_filter($this->commands, fn($cmd) => !$cmd['success']);
        
        echo "✅ Successful commands: " . count($successful) . "\n";
        echo "❌ Failed commands: " . count($failed) . "\n\n";
        
        if (!empty($failed)) {
            echo "⚠️  FAILED COMMANDS:\n";
            foreach ($failed as $cmd) {
                echo "   - " . $cmd['command'] . "\n";
            }
            echo "\n";
        }
        
        echo "🎉 Deployment completed!\n\n";
        
        echo "📝 NEXT STEPS FOR PRODUCTION:\n";
        echo "1. Ensure your .env file has correct APP_URL\n";
        echo "2. Set APP_ENV=production and APP_DEBUG=false\n";
        echo "3. Configure your web server to serve from /public\n";
        echo "4. Run 'npm run build' to compile assets\n";
        echo "5. Upload the /public/build directory to your server\n\n";
    }
}

// Run deployment
try {
    $deployer = new DeploymentManager();
    $deployer->run();
} catch (Exception $e) {
    echo "❌ Deployment failed: " . $e->getMessage() . "\n";
    exit(1);
}
