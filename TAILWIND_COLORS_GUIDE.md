# Tailwind CSS Color Usage Guide for Zuppie

## Overview
This guide shows how to use the centralized color system defined in `tailwind.config.js` throughout your Zuppie project.

## Color Configuration Location
All colors are defined in: `/tailwind.config.js`

## Available Color Palettes

### 1. Primary Brand Colors - `zuppie-*`
```html
<!-- Light shades -->
<div class="bg-zuppie-50">Very light purple</div>
<div class="bg-zuppie-100">Light purple</div>
<div class="bg-zuppie-200">Lighter purple</div>
<div class="bg-zuppie-300">Light purple</div>
<div class="bg-zuppie-400">Medium light purple</div>

<!-- Primary and darker shades -->
<div class="bg-zuppie-500">Primary purple (#8b5cf6)</div>
<div class="bg-zuppie-600">Dark purple</div>
<div class="bg-zuppie-700">Darker purple</div>
<div class="bg-zuppie-800">Very dark purple</div>
<div class="bg-zuppie-900">Darkest purple</div>
<div class="bg-zuppie-950">Ultra dark purple</div>
```

### 2. Secondary Brand Colors - `zuppie-pink-*`
```html
<!-- Light shades -->
<div class="bg-zuppie-pink-50">Very light pink</div>
<div class="bg-zuppie-pink-100">Light pink</div>
<div class="bg-zuppie-pink-200">Lighter pink</div>
<div class="bg-zuppie-pink-300">Light pink</div>
<div class="bg-zuppie-pink-400">Medium light pink</div>

<!-- Primary and darker shades -->
<div class="bg-zuppie-pink-500">Primary pink (#ec4899)</div>
<div class="bg-zuppie-pink-600">Dark pink</div>
<div class="bg-zuppie-pink-700">Darker pink</div>
<div class="bg-zuppie-pink-800">Very dark pink</div>
<div class="bg-zuppie-pink-900">Darkest pink</div>
<div class="bg-zuppie-pink-950">Ultra dark pink</div>
```

### 3. Event Package Colors
```html
<div class="bg-package-birthday-500">Birthday Events (#f97316)</div>
<div class="bg-package-wedding-500">Wedding Events (#ef4444)</div>
<div class="bg-package-corporate-500">Corporate Events (#3b82f6)</div>
<div class="bg-package-anniversary-500">Anniversary Events (#8b5cf6)</div>
```

### 4. Utility Colors
```html
<div class="bg-success-500">Success (#22c55e)</div>
<div class="bg-warning-500">Warning (#f59e0b)</div>
<div class="bg-error-500">Error (#ef4444)</div>
<div class="bg-info-500">Info (#3b82f6)</div>
```

## Usage Examples

### Text Colors
```html
<h1 class="text-zuppie-500">Primary purple text</h1>
<h2 class="text-zuppie-pink-600">Pink text</h2>
<p class="text-success-500">Success message</p>
<span class="text-error-500">Error message</span>
```

### Background Colors
```html
<div class="bg-zuppie-500 text-white">Purple background</div>
<div class="bg-zuppie-pink-500 text-white">Pink background</div>
<div class="bg-package-birthday-50">Light birthday theme</div>
```

### Border Colors
```html
<div class="border border-zuppie-300">Purple border</div>
<div class="border-2 border-zuppie-pink-400">Thick pink border</div>
<button class="border border-success-500">Success button</button>
```

### Gradients (Custom Components)
```html
<div class="gradient-bg">Uses Zuppie brand gradient</div>
<h1 class="gradient-text">Gradient text effect</h1>
<button class="btn-primary">Primary button with gradient</button>
<button class="btn-secondary">Secondary button with gradient</button>
```

### Custom Classes (Defined in CSS)
```html
<div class="glass-effect">Glassmorphism effect</div>
<div class="card-hover">Hover animation</div>
<div class="animate-float">Floating animation</div>
<div class="animate-sparkle">Sparkle animation</div>
```

## Changing Colors in the Future

### Method 1: Update tailwind.config.js
To change the primary purple color:
```javascript
// In tailwind.config.js
'zuppie': {
  500: '#your-new-color', // Change this line
  // Other shades will need manual updating
}
```

### Method 2: Add New Color Variants
```javascript
// In tailwind.config.js
'zuppie-blue': {
  50: '#eff6ff',
  500: '#3b82f6',
  900: '#1e3a8a',
},
```

### Method 3: Update Event Package Colors
```javascript
// In tailwind.config.js
'package': {
  'birthday': {
    500: '#new-birthday-color',
  },
  'wedding': {
    500: '#new-wedding-color',
  },
}
```

## Files That Use These Colors

### 1. Layout Files
- `resources/views/components/layouts/app.blade.php`
- All Livewire components
- All Blade templates

### 2. CSS Files
- `resources/css/app.css` (custom components)
- Built CSS in `public/build/assets/`

### 3. Configuration Files
- `tailwind.config.js` (color definitions)
- `postcss.config.js` (build process)
- `vite.config.js` (asset compilation)

## Best Practices

### 1. Use Semantic Names
```html
<!-- Good -->
<div class="bg-success-500">Operation successful</div>
<div class="bg-package-birthday-500">Birthday package</div>

<!-- Avoid direct hex values -->
<div style="background-color: #22c55e">Don't do this</div>
```

### 2. Consistent Shade Usage
```html
<!-- Use consistent shades for similar elements -->
<h1 class="text-zuppie-600">Main heading</h1>
<h2 class="text-zuppie-600">Sub heading</h2>
<h3 class="text-zuppie-500">Minor heading</h3>
```

### 3. Proper Contrast
```html
<!-- Good contrast -->
<div class="bg-zuppie-500 text-white">Readable</div>
<div class="bg-zuppie-50 text-zuppie-900">Good contrast</div>

<!-- Poor contrast -->
<div class="bg-zuppie-500 text-zuppie-400">Hard to read</div>
```

## Development Commands

### Build CSS
```bash
npm run build
```

### Development Server
```bash
npm run dev
```

### Test Colors
Visit: `http://localhost:5173/tailwind-test.html`

## Troubleshooting

### Colors Not Showing
1. Check if Vite dev server is running
2. Ensure `@vite('resources/css/app.css')` is in your Blade template
3. Run `npm run build` to compile CSS
4. Clear browser cache

### Custom Colors Not Working
1. Check `tailwind.config.js` syntax
2. Restart Vite dev server after config changes
3. Ensure color names don't conflict with Tailwind defaults

### CSS Not Loading
1. Check Vite configuration in `vite.config.js`
2. Ensure PostCSS is configured correctly
3. Check for compilation errors in terminal

## Support
For issues or questions about the color system, check:
1. This documentation
2. `tailwind.config.js` for available colors
3. `tailwind-test.html` for working examples
