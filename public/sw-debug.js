// Service Worker Debug Helper
// Add this script to your page during development to help with SW issues

(function() {
    'use strict';
    
    // Add debug methods to window
    window.swDebug = {
        // Unregister all service workers
        unregisterAll: async function() {
            if ('serviceWorker' in navigator) {
                const registrations = await navigator.serviceWorker.getRegistrations();
                for (let registration of registrations) {
                    await registration.unregister();
                    console.log('Unregistered SW:', registration.scope);
                }
                console.log('All service workers unregistered');
            }
        },
        
        // Clear all caches
        clearCaches: async function() {
            const cacheNames = await caches.keys();
            for (let cacheName of cacheNames) {
                await caches.delete(cacheName);
                console.log('Deleted cache:', cacheName);
            }
            console.log('All caches cleared');
        },
        
        // Full reset (unregister SW + clear caches + reload)
        fullReset: async function() {
            await this.unregisterAll();
            await this.clearCaches();
            console.log('Full reset complete. Reloading page...');
            window.location.reload();
        },
        
        // Check SW status
        checkStatus: async function() {
            if ('serviceWorker' in navigator) {
                const registrations = await navigator.serviceWorker.getRegistrations();
                console.log('Active registrations:', registrations.length);
                registrations.forEach((reg, index) => {
                    console.log(`Registration ${index + 1}:`, {
                        scope: reg.scope,
                        active: reg.active ? 'Yes' : 'No',
                        installing: reg.installing ? 'Yes' : 'No',
                        waiting: reg.waiting ? 'Yes' : 'No'
                    });
                });
                
                const cacheNames = await caches.keys();
                console.log('Active caches:', cacheNames);
            }
        }
    };
    
    // Auto-check status on load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => window.swDebug.checkStatus(), 1000);
        });
    } else {
        setTimeout(() => window.swDebug.checkStatus(), 1000);
    }
    
    console.log('SW Debug Helper loaded. Available methods:');
    console.log('- swDebug.unregisterAll()');
    console.log('- swDebug.clearCaches()');
    console.log('- swDebug.fullReset()');
    console.log('- swDebug.checkStatus()');
})();