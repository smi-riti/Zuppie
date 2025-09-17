const CACHE_NAME = 'zuppie-v2';
const OFFLINE_URL = '/offline.html';

// Essential resources that should exist
const CORE_CACHE_RESOURCES = [
    '/',
    '/offline.html',
    '/images/logo.jpeg',
    '/images/logo.png'
];

// Optional resources - cache if available
const OPTIONAL_CACHE_RESOURCES = [
    '/build/assets/app-BOb1W5vC.css',
    '/build/assets/app-DNxiirP_.js',
    'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
    'https://unpkg.com/aos@2.3.1/dist/aos.css',
    'https://unpkg.com/aos@2.3.1/dist/aos.js',
    'https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js'
];

// Helper function to cache resources with error handling
async function cacheResources(cache, resources, isOptional = false) {
    const promises = resources.map(async (resource) => {
        try {
            const response = await fetch(resource);
            if (response.ok) {
                await cache.put(resource, response);
                console.log(`Cached: ${resource}`);
            } else if (!isOptional) {
                console.warn(`Failed to cache core resource: ${resource} - Status: ${response.status}`);
            }
        } catch (error) {
            if (!isOptional) {
                console.warn(`Error caching core resource: ${resource}`, error);
            } else {
                console.log(`Optional resource not available: ${resource}`);
            }
        }
    });
    
    await Promise.allSettled(promises);
}

// Install event
self.addEventListener('install', event => {
    console.log('Service Worker installing...');
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(async (cache) => {
                try {
                    // Cache core resources first
                    await cacheResources(cache, CORE_CACHE_RESOURCES, false);
                    
                    // Cache optional resources
                    await cacheResources(cache, OPTIONAL_CACHE_RESOURCES, true);
                    
                    console.log('Service Worker installation completed');
                } catch (error) {
                    console.error('Service Worker installation failed:', error);
                }
            })
            .then(() => {
                return self.skipWaiting();
            })
            .catch(error => {
                console.error('Service Worker cache opening failed:', error);
            })
    );
});

// Activate event
self.addEventListener('activate', event => {
    console.log('Service Worker activating...');
    event.waitUntil(
        Promise.all([
            // Clean up old caches
            caches.keys().then(cacheNames => {
                return Promise.all(
                    cacheNames.map(cacheName => {
                        if (cacheName !== CACHE_NAME) {
                            console.log('Deleting old cache:', cacheName);
                            return caches.delete(cacheName);
                        }
                    })
                );
            }),
            // Take control of all clients immediately
            self.clients.claim()
        ]).then(() => {
            console.log('Service Worker activated and controlling all clients');
        }).catch(error => {
            console.error('Service Worker activation failed:', error);
        })
    );
});

// Fetch event with better error handling
self.addEventListener('fetch', event => {
    // Skip non-http requests
    if (!event.request.url.startsWith('http')) {
        return;
    }
    
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request)
                .then(response => {
                    // Clone the response before caching
                    const responseClone = response.clone();
                    if (response.ok && response.type === 'basic') {
                        caches.open(CACHE_NAME).then(cache => {
                            cache.put(event.request, responseClone);
                        });
                    }
                    return response;
                })
                .catch(() => {
                    return caches.open(CACHE_NAME)
                        .then(cache => {
                            return cache.match(OFFLINE_URL);
                        });
                })
        );
    } else {
        event.respondWith(
            caches.match(event.request)
                .then(response => {
                    if (response) {
                        return response;
                    }
                    
                    return fetch(event.request)
                        .then(fetchResponse => {
                            // Clone the response before caching
                            const responseClone = fetchResponse.clone();
                            if (fetchResponse.ok && fetchResponse.type === 'basic') {
                                caches.open(CACHE_NAME).then(cache => {
                                    cache.put(event.request, responseClone);
                                });
                            }
                            return fetchResponse;
                        })
                        .catch(error => {
                            console.log('Fetch failed for:', event.request.url, error);
                            // Return a basic response for failed requests
                            return new Response('Network error', { 
                                status: 408,
                                statusText: 'Network error' 
                            });
                        });
                })
        );
    }
});

// Background sync for form submissions
self.addEventListener('sync', event => {
    if (event.tag === 'background-sync') {
        console.log('Background sync triggered');
        event.waitUntil(doBackgroundSync());
    }
});

function doBackgroundSync() {
    try {
        // Handle background sync for form submissions
        return Promise.resolve();
    } catch (error) {
        console.error('Background sync failed:', error);
        return Promise.reject(error);
    }
}

// Push notifications with better error handling
self.addEventListener('push', event => {
    if (event.data) {
        try {
            const data = event.data.json();
            const options = {
                body: data.body,
                icon: '/images/logo.png',
                badge: '/images/logo.png',
                vibrate: [100, 50, 100],
                data: {
                    dateOfArrival: Date.now(),
                    primaryKey: data.primaryKey
                },
                actions: [
                    {
                        action: 'explore',
                        title: 'View Details'
                    },
                    {
                        action: 'close',
                        title: 'Close'
                    }
                ]
            };
            
            event.waitUntil(
                self.registration.showNotification(data.title, options)
            );
        } catch (error) {
            console.error('Push notification error:', error);
        }
    }
});

// Handle notification clicks
self.addEventListener('notificationclick', event => {
    event.notification.close();
    
    if (event.action === 'explore') {
        event.waitUntil(
            clients.openWindow('/')
        );
    } else if (event.action === 'close') {
        event.notification.close();
    }
});

// Handle messages from clients
self.addEventListener('message', event => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
    
    if (event.data && event.data.type === 'GET_VERSION') {
        event.ports[0].postMessage({ version: CACHE_NAME });
    }
});

// Error handling
self.addEventListener('error', event => {
    console.error('Service Worker error:', event.error);
});

self.addEventListener('unhandledrejection', event => {
    console.error('Service Worker unhandled promise rejection:', event.reason);
    event.preventDefault();
});
