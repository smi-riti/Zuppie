<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

<script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom CSS -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    @livewireStyles
    <!-- Font Awesome for Icons -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </noscript>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

    <!-- Chart.js for dashboard charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4,
        .prose h5,
        .prose h6 {
            color: #111827;
            font-weight: 600;
            margin-top: 1.5em;
            margin-bottom: 0.75em;
        }

        .prose h2 {
            font-size: 1.5em;
        }

        .prose h3 {
            font-size: 1.25em;
        }

        .prose p {
            margin-bottom: 1em;
        }

        .prose ul,
        .prose ol {
            margin-bottom: 1em;
            padding-left: 1.5em;
        }

        .prose ul li {
            list-style-type: disc;
        }

        .prose ol li {
            list-style-type: decimal;
        }

        .prose strong {
            font-weight: 600;
        }

        .prose em {
            font-style: italic;
        }

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
        <div class="fixed ">
            <x-admin.sidebar />
        </div>
        <!-- Main Content Area -->
        <div class="flex-1 ml-[15%] flex flex-col bg-gradient-to-br from-purple-50 to-pink-50 p-2">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>