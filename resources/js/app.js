import './bootstrap';

// Image Loading and Cache Management
window.ImageLoader = {
    cache: new Map(),
    
    // Preload ImageKit images with retry mechanism
    preloadImage(src, retries = 3) {
        return new Promise((resolve, reject) => {
            if (this.cache.has(src)) {
                resolve(this.cache.get(src));
                return;
            }
            
            const img = new Image();
            img.crossOrigin = 'anonymous';
            
            const attemptLoad = (attemptsLeft) => {
                img.onload = () => {
                    this.cache.set(src, true);
                    resolve(img);
                };
                
                img.onerror = () => {
                    if (attemptsLeft > 0) {
                        console.log(`Retrying image load: ${src}, attempts left: ${attemptsLeft}`);
                        setTimeout(() => attemptLoad(attemptsLeft - 1), 1000);
                    } else {
                        console.error(`Failed to load image after ${retries} attempts: ${src}`);
                        reject(new Error(`Image failed to load: ${src}`));
                    }
                };
                
                img.src = src;
            };
            
            attemptLoad(retries);
        });
    },
    
    // Initialize lazy loading with intersection observer
    initLazyLoading() {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    const src = img.dataset.src;
                    
                    if (src) {
                        this.loadImageWithFallback(img, src);
                        observer.unobserve(img);
                    }
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.01
        });
        
        // Observe all images with data-src
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    },
    
    // Load image with fallback support
    loadImageWithFallback(imgElement, src) {
        imgElement.classList.add('loading');
        
        this.preloadImage(src)
            .then(() => {
                imgElement.src = src;
                imgElement.classList.remove('loading');
                imgElement.classList.add('loaded');
            })
            .catch(() => {
                // Try alternative formats or fallback
                const fallbackSrc = this.getFallbackImage(src);
                if (fallbackSrc && fallbackSrc !== src) {
                    this.preloadImage(fallbackSrc)
                        .then(() => {
                            imgElement.src = fallbackSrc;
                            imgElement.classList.remove('loading');
                            imgElement.classList.add('loaded');
                        })
                        .catch(() => {
                            this.setPlaceholder(imgElement);
                        });
                } else {
                    this.setPlaceholder(imgElement);
                }
            });
    },
    
    // Handle local assets with proper URL resolution
    resolveAssetUrl(src) {
        if (src.startsWith('http')) {
            return src;
        }
        
        const baseUrl = window.Laravel?.assetUrl || window.Laravel?.baseUrl || '';
        if (src.startsWith('/')) {
            return baseUrl + src;
        }
        
        return baseUrl + '/' + src;
    },
    
    // Generate fallback image URL
    getFallbackImage(src) {
        if (src.includes('imagekit.io')) {
            // Try WebP format first, then lower quality
            if (!src.includes('tr=')) {
                return src + '?tr=f-webp,q-80';
            } else if (!src.includes('f-webp')) {
                return src.replace('tr=', 'tr=f-webp,');
            } else if (!src.includes('q-')) {
                return src.replace('tr=', 'tr=q-70,');
            }
        } else if (src.includes('/images/')) {
            // For local images, try different formats
            const baseSrc = src.replace(/\.[^/.]+$/, '');
            const currentExt = src.split('.').pop().toLowerCase();
            
            // Try WebP first, then JPEG, then PNG
            if (currentExt !== 'webp') {
                return baseSrc + '.webp';
            } else if (currentExt !== 'jpg' && currentExt !== 'jpeg') {
                return baseSrc + '.jpg';
            } else if (currentExt !== 'png') {
                return baseSrc + '.png';
            }
        }
        return null;
    },
    
    // Set placeholder for failed images
    setPlaceholder(imgElement) {
        const width = imgElement.getAttribute('width') || 400;
        const height = imgElement.getAttribute('height') || 300;
        imgElement.src = `data:image/svg+xml;base64,${btoa(`
            <svg width="${width}" height="${height}" xmlns="http://www.w3.org/2000/svg">
                <rect width="100%" height="100%" fill="#f3f4f6"/>
                <text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="#9ca3af" font-family="Arial, sans-serif" font-size="14">
                    Image not available
                </text>
            </svg>
        `)}`;
        imgElement.classList.remove('loading');
        imgElement.classList.add('loaded', 'error');
    }
};

// Mobile Navigation Handler
window.MobileNav = {
    init() {
        // Ensure mobile menu is closed by default
        document.addEventListener('DOMContentLoaded', () => {
            const mobileMenus = document.querySelectorAll('[x-data*="open"]');
            mobileMenus.forEach(menu => {
                if (menu._x_dataStack) {
                    menu._x_dataStack[0].open = false;
                }
            });
            
            // Initialize header responsiveness
            this.initHeaderResponsiveness();
        });
        
        // Handle resize events
        window.addEventListener('resize', this.handleResize.bind(this));
        this.handleResize();
    },
    
    initHeaderResponsiveness() {
        const header = document.querySelector('header');
        if (!header) return;
        
        // Add responsive classes based on screen size
        const updateHeaderClasses = () => {
            const width = window.innerWidth;
            header.classList.toggle('header-mobile', width < 768);
            header.classList.toggle('header-tablet', width >= 768 && width < 1024);
            header.classList.toggle('header-desktop', width >= 1024);
        };
        
        updateHeaderClasses();
        window.addEventListener('resize', updateHeaderClasses);
    },
    
    handleResize() {
        // Close mobile menu when switching to desktop
        if (window.innerWidth >= 768) {
            const mobileMenus = document.querySelectorAll('[x-data*="open"]');
            mobileMenus.forEach(menu => {
                if (menu._x_dataStack) {
                    menu._x_dataStack[0].open = false;
                }
            });
        }
    }
};

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    ImageLoader.initLazyLoading();
    MobileNav.init();
    
    // Preload critical images (both ImageKit and local)
    const criticalImages = document.querySelectorAll('img[data-critical="true"]');
    criticalImages.forEach(img => {
        const src = img.dataset.src || img.src;
        if (src) {
            // Handle both ImageKit and local images
            const resolvedSrc = src.includes('imagekit.io') ? src : ImageLoader.resolveAssetUrl(src);
            ImageLoader.preloadImage(resolvedSrc).then(() => {
                if (img.dataset.src) {
                    img.src = resolvedSrc;
                    img.classList.add('loaded');
                }
            }).catch(() => {
                console.warn('Failed to preload critical image:', resolvedSrc);
            });
        }
    });
});

// Handle Livewire page navigation
document.addEventListener('livewire:navigated', function() {
    ImageLoader.initLazyLoading();
    
    // Small delay to ensure DOM is ready
    setTimeout(() => {
        const mobileMenus = document.querySelectorAll('[x-data*="open"]');
        mobileMenus.forEach(menu => {
            if (menu._x_dataStack) {
                menu._x_dataStack[0].open = false;
            }
        });
    }, 100);
});
