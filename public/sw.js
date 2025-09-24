const CACHE_NAME = "zuppie-v4";
const OFFLINE_URL = "/offline.html";

// Core files that must be cached
const CORE_CACHE_RESOURCES = [
  "/",
  "/offline.html",
  "/images/zuppie-logo.jpeg",
  "/images/zuppie-logo.png",
];

// Install event → pre-cache core files
self.addEventListener("install", (event) => {
  console.log("[SW] Installing...");
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(CORE_CACHE_RESOURCES);
    })
  );
  self.skipWaiting();
});

// Activate event → clear old caches
self.addEventListener("activate", (event) => {
  console.log("[SW] Activating...");
  event.waitUntil(
    caches.keys().then((keys) =>
      Promise.all(keys.map((key) => key !== CACHE_NAME && caches.delete(key)))
    )
  );
  self.clients.claim();
});

// Fetch event → network first for pages, cache first for assets
self.addEventListener("fetch", (event) => {
  if (event.request.method !== "GET") return;

  if (event.request.mode === "navigate") {
    // Page navigation → try network, fallback to offline
    event.respondWith(
      fetch(event.request)
        .then((response) => {
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(event.request, response.clone());
          });
          return response;
        })
        .catch(() => caches.match(OFFLINE_URL))
    );
  } else {
    // Assets → try cache, fallback to network
    event.respondWith(
      caches.match(event.request).then((cached) => {
        return (
          cached ||
          fetch(event.request)
            .then((response) => {
              if (
                response.ok &&
                (response.type === "basic" || response.type === "cors")
              ) {
                caches.open(CACHE_NAME).then((cache) => {
                  cache.put(event.request, response.clone());
                });
              }
              return response;
            })
            .catch(() => {
              // fallback for images
              if (event.request.destination === "image") {
                return caches.match("/images/zuppie-logo.png");
              }
              return new Response("Offline", { status: 503 });
            })
        );
      })
    );
  }
});

// Background sync placeholder
self.addEventListener("sync", (event) => {
  if (event.tag === "background-sync") {
    console.log("[SW] Background sync triggered");
    event.waitUntil(Promise.resolve());
  }
});

// Push notifications
self.addEventListener("push", (event) => {
  if (!event.data) return;
  const data = event.data.json();
  const options = {
    body: data.body,
    icon: "/images/zuppie-logo.png",
    badge: "/images/zuppie-logo.png",
    vibrate: [100, 50, 100],
  };
  event.waitUntil(self.registration.showNotification(data.title, options));
});

// Notification clicks
self.addEventListener("notificationclick", (event) => {
  event.notification.close();
  if (event.action === "explore") {
    event.waitUntil(clients.openWindow("/"));
  }
});

// Force update when message received
self.addEventListener("message", (event) => {
  if (event.data?.type === "SKIP_WAITING") {
    self.skipWaiting();
  }
});
