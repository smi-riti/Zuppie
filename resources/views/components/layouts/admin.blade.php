<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8b5cf6',  // zuppie-500
                        secondary: '#ec4899',  // zuppie-pink-500
                        dark: '#1F2937',
                        light: '#F9FAFB',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }
        
        /* Responsive table display */
        .desktop-table {
            display: none;
        }
        
        @media (min-width: 768px) {
            .desktop-table {
                display: block !important;
            }
        }
        
        /* Basic prose styles for blog content */
        .prose {
            color: #374151;
            line-height: 1.75;
        }
        .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
            color: #111827;
            font-weight: 600;
            margin-top: 1.5em;
            margin-bottom: 0.75em;
        }
        .prose h2 { font-size: 1.5em; }
        .prose h3 { font-size: 1.25em; }
        .prose p { margin-bottom: 1em; }
        .prose ul, .prose ol { margin-bottom: 1em; padding-left: 1.5em; }
        .prose ul li { list-style-type: disc; }
        .prose ol li { list-style-type: decimal; }
        .prose strong { font-weight: 600; }
        .prose em { font-style: italic; }
        .prose blockquote {
            border-left: 4px solid #e5e7eb;
            padding-left: 1em;
            color: #6b7280;
            font-style: italic;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 font-sans antialiased min-h-screen">
    <!-- Main Layout Container -->
    <div class="flex h-screen ">
        <!-- Sidebar -->
        <x-admin.sidebar />

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
           {{ $slot }}
        </div>
    </div>
    
    @livewireScripts
    @stack('scripts')
</body>

</html>



