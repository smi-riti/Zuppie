<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lightgallery.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Admin | {{ $title ?? 'Page Title' }}</title>
    @livewireStyles
</head>

<body class="bg-gray-50 min-h-screen font-sans flex flex-col">
    <livewire:public.section.header />

    <main class="flex-grow mt-[5%]">
        {{ $slot }}
    </main>
    <livewire:public.section.footer />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/lightgallery.min.js"></script>
    @livewireScripts
</body>



</html>