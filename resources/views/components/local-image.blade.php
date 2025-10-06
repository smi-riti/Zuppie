@props([
    'src' => '',
    'alt' => '',
    'class' => '',
    'lazy' => true,
    'critical' => false,
    'width' => null,
    'height' => null,
    'fallback' => null
])

@php
    // Handle both asset() URLs and direct paths
    $imageSrc = $src;
    if (!str_starts_with($src, 'http') && !str_starts_with($src, '/')) {
        // It's a relative path, use asset() helper
        $imageSrc = asset($src);
    } elseif (str_starts_with($src, '/') && !str_starts_with($src, 'http')) {
        // It's an absolute path, ensure it's properly formatted
        $imageSrc = config('app.url') . $src;
    }

    // Determine if image should be lazy loaded
    $shouldLazyLoad = $lazy && !$critical;
    
    // Build CSS classes
    $cssClasses = trim($class . ' transition-all duration-300');
    if ($shouldLazyLoad) {
        $cssClasses .= ' loading';
    }
    
    // Build attributes
    $attributes = [
        'alt' => $alt,
        'class' => $cssClasses,
        'loading' => $shouldLazyLoad ? 'lazy' : 'eager',
        'decoding' => $critical ? 'sync' : 'async',
    ];
    
    if ($width) $attributes['width'] = $width;
    if ($height) $attributes['height'] = $height;
    
    if ($critical) {
        $attributes['data-critical'] = 'true';
    }
    
    // For lazy loading, use data-src initially
    if ($shouldLazyLoad) {
        $attributes['data-src'] = $imageSrc;
        $attributes['src'] = 'data:image/svg+xml;base64,' . base64_encode('
            <svg width="' . ($width ?: 400) . '" height="' . ($height ?: 300) . '" xmlns="http://www.w3.org/2000/svg">
                <rect width="100%" height="100%" fill="#f3f4f6"/>
                <circle cx="50%" cy="50%" r="20" fill="#e5e7eb"/>
                <animate attributeName="opacity" values="0.5;1;0.5" dur="1.5s" repeatCount="indefinite"/>
            </svg>
        ');
    } else {
        $attributes['src'] = $imageSrc;
    }
@endphp

<img {{ collect($attributes)->map(fn($value, $key) => $key . '="' . e($value) . '"')->implode(' ') }}
     @if($fallback) 
         onerror="this.onerror=null; this.src='{{ $fallback }}'; this.classList.add('error');"
     @endif
>

@once
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize local image loading
    if (window.ImageLoader) {
        window.ImageLoader.initLazyLoading();
    }
});
</script>
@endpush
@endonce