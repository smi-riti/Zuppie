<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin | {{ $title ?? 'Page Title' }}</title>
 
</head>

<body class="bg-gray-50 min-h-screen font-sans flex flex-col">
  

    <main class="flex-grow mt-[5%]">
        {{ $slot }}
    </main>
  
</body>



</html>