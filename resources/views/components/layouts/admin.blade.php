<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | {{ $title ?? 'Page Title' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <x-admin.header />
    <div class="flex-1 flex">
            <x-admin.sidebar />
            <main class="flex-1 p-4">
                {{ $slot }}
            </main>
        </div>

</body>

</html>
