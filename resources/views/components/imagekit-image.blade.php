@props([
    'src' => '',
    'alt' => '',
    'class' => '',
    'lazy' => true,
    'critical' => false,
    'width' => null,
    'height' => null,
    'fallback' => null,
    'transformations' => 'tr=f-auto,q-80'
])

@php
    // Build ImageKit URL with optimizations
    $imageSrc = $src;
    if ($src && str_contains($src, 'imagekit.io')) {
        $separator = str_contains($src, '?') ? '&' : '?';
        if (!str_contains($src, 'tr=')) {
            $imageSrc = $src . $separator . $transformations;
        }
    }
    
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
    
    // Fallback for ImageKit
    $fallbackUrl = $fallback ?: (asset('images/placeholder.jpg'));
@endphp

<img {{ collect($attributes)->map(fn($value, $key) => $key . '="' . e($value) . '"')->implode(' ') }}
     onerror="console.log('ImageKit failed to load:', this.src); this.onerror=null; this.src='{{ $fallbackUrl }}'; this.style.opacity='0.5';"
     onload="console.log('ImageKit loaded successfully:', this.src); this.style.opacity='1';"
     style="opacity: 0.8;">

