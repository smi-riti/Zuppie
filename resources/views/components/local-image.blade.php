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
    // Always use asset() helper for local images
    $imageSrc = asset($src);
    
    // Build CSS classes
    $cssClasses = trim($class . ' transition-opacity duration-300');
    
    // Build attributes
    $attributes = [
        'alt' => $alt,
        'class' => $cssClasses,
        'src' => $imageSrc,
        'loading' => ($lazy && !$critical) ? 'lazy' : 'eager',
        'decoding' => $critical ? 'sync' : 'async',
    ];
    
    if ($width) $attributes['width'] = $width;
    if ($height) $attributes['height'] = $height;
    
    // Add fallback error handling
    $fallbackUrl = $fallback ? asset($fallback) : asset('images/placeholder.jpg');
@endphp

<img {{ collect($attributes)->map(fn($value, $key) => $key . '="' . e($value) . '"')->implode(' ') }}
     onerror="console.log('Image failed to load:', this.src); this.onerror=null; this.src='{{ $fallbackUrl }}'; this.style.opacity='0.5';"
     onload="console.log('Image loaded successfully:', this.src); this.style.opacity='1';"
     style="opacity: 0.8;">

